<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'ادیت']);
        Permission::create(['name' => 'پاک کردن']);
        Permission::create(['name' => 'ایجاد کردن']);


        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'کاربر']);
        $role->givePermissionTo(Permission::all());


        $role = Role::create(['name' => 'ادمین']);
        $role->givePermissionTo(Permission::all());
    }



}