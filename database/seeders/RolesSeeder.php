<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    protected $data = [
        'super_admin' => ['description' => 'Super Admin', 'permissions' => [
            'index_roles',
            'view_roles',
            'edit_roles',
            'delete_roles',

            // users permissions
            'index_users',
            'view_users',
            'edit_users' ,
            'delete_users' ,
            'force_delete_users',
            'approve_users' ,
        ]],

        'guest' => ['description' => 'Guest', 'permissions' => [
            //
        ]],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->data as $name => $vals) {
            $role = Role::firstOrCreate(['name' => $name, 'guard_name' => 'web_admin']);
            $role->update(Arr::only($vals, 'description'));

            //add the permissions
            $role->syncPermissions($vals['permissions']);

            $role->save();
        }
    }
}
