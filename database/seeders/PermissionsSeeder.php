<?php

namespace Database\Seeders;

use App\Support\Roles\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    protected $data = [
        'roles' => [
            'index_roles' => 'View roles module',
            'view_roles' => 'View roles',
            'edit_roles' => 'Edit roles',
            'delete_roles' => 'Delete roles',
        ],

        'users' => [
            'index_users' => 'View users module',
            'view_users' => 'View users',
            'edit_users' => 'Edit users',
            'delete_users' => 'Delete users',
            'force_delete_users' => 'Force delete users',
            'approve_users' => 'Approve users',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $model => $permissions) {
            foreach ($permissions as $name => $desc) {
                $permission = Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web_admin']);
                $permission->update(['description' => $desc, 'model' => $model]);
                $permission->save();
            }
        }
    }
}
