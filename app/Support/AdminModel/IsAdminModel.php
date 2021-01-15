<?php


namespace App\Support\AdminModel;


//use App\Http\Controllers\Admin\LogsController;
use Carbon\Carbon;

class IsAdminModel
{
    /**
     * Get admin user attribute
     *
     * @return string
     */
    public function getAdminLinkAttribute(): string
    {
        if ($this->canViewAdminLink()) {
            $admin_url = $this->admin_url;
        } else {
            $admin_url = '';
        }

        $before = $admin_url ? '<a href="' . e($admin_url) . '">' : '';
        $after = $admin_url ? '</a>' : '';

        return $before . e($this->admin_link_name) . $after;
    }

    /**
     * Get can view admin link
     *
     * @return boolean
     */
    public function canViewAdminLink(): bool
    {
        return auth()->check() && auth()->user()->can('update', $this);
    }

    /**
     * Get the name for the admin link
     *
     * @return string
     */
    public function getAdminLinkNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the name for log
     *
     * @return string
     */
    public function getLoggingNameAttribute(): ?string
    {
        return null;
        return $this->admin_link_name;
    }

    /**
     * Get the log url
     *
     * @return string
     */
    public function getLogUrlAttribute(): ?string
    {
        return null;
        /*return add_query_arg([
            'subject_type' => $this->getMorphClass(),
            'subject_id' => $this->id,
        ], action('App\\Http\\Controllers\\Admin\\LogsController@index'));*/
    }

    /**
     * Get the causer log url
     *
     * @return string
     */
    public function getCauserLogUrlAttribute(): ?string
    {
        return null;
    }

    /**
     * Last week scope
     *
     * @param $query
     * @param string $field
     * @return mixed
     */
    public function scopeLastWeek($query, $field = 'created_at')
    {
        $last_week = Carbon::now()->subWeek();
        $now = Carbon::now();

        return $query->whereBetween($field, [$last_week, $now]);
    }
}
