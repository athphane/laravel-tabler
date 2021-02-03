<?php


namespace App\Support\ActivityLog;


use App\Helpers\Activitylog\Enums\SubjectTypes;
use App\Support\AdminModel\AdminModel;
use App\Support\AdminModel\IsAdminModel;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity implements AdminModel
{
    use IsAdminModel;

    /**
     * A search scope
     * @param $query
     * @param $search
     * @return
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('description', $search);
    }

    /**
     * @inheritDoc
     */
    public function getAdminUrlAttribute(): string
    {
        return route('admin.activity.show', $this);
    }

    /**
     * Get name attribute
     * @return string
     */
    public function getAdminLinkNameAttribute(): string
    {
        /** @var Carbon $date */
        if ($date = $this->created_at) {
            return __(':rel (:time)', ['rel' => $date->diffForHumans(), 'time' => $date->format('j M Y @ H:i')]);
        }

        return __('Log #:id', ['id' => $this->id]);
    }

    /**
     * Get can view admin link
     *
     * @return boolean
     */
    public function canViewAdminLink(): bool
    {
        return auth()->check() && auth()->user()->can('view', $this);
    }

    /**
     * With relations scope
     * @param $query
     * @return
     */
    public function scopeWithRelations($query)
    {
        return $query->with('causer', 'subject');
    }

    /**
     * User visible scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeUserVisible($query)
    {
        $user = auth()->user();

        if ($user && $user->can('index', static::class)) {
            if ($user->can('view_all_logs')) {
                // can view all
                return $query;
            } else {
                return $query->whereIn('subject_type', $this->allowedSubjects($user));
            }
        }

        return $query->whereId(-1);
    }

    /**
     * Get the allowed subjects for the user
     *
     * @param User $user
     * @return array
     */
    public function allowedSubjects(User $user)
    {
        $allowed = [];

        $types = SubjectTypes::getTypes();
        foreach ($types as $type) {
            if ($user->can('create', $type)) {
                $allowed[] = (new $type())->getMorphClass();
            }
        }

        return $allowed;
    }
}
