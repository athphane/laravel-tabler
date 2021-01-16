<?php

namespace App\Models;

use App\Support\AdminModel\AdminModel;
use App\Support\AdminModel\IsAdminModel;
use App\Support\Roles\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, AdminModel
{
    use HasFactory, Notifiable, HasRoles;
    use IsAdminModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function loginUrl(): string
    {
        return route('admin.login');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }

    /**
     * @inheritDoc
     */
    public function getAdminUrlAttribute(): string
    {
        return route('admin.users.edit', $this);
    }

    /**
     * Get user initials
     *
     * @return string
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(" ", $this->name);

        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }

        return Str::upper($initials);
    }

    /**
     * Get role attribute
     *
     * @return Role
     */
    public function getRoleAttribute(): Role
    {
        return $this->roles->first();
    }
}
