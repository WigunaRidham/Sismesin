<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new \App\Role();
        $role_employee->name = 'admin';
        $role_employee->description = 'Administrator';
        $role_employee->save();

        $role_manager = new \App\Role();
        $role_manager->name = 'kepala';
        $role_manager->description = 'Kepala UPT';
        $role_manager->save();

        $role_employee = new \App\Role();
        $role_employee->name = 'user';
        $role_employee->description = 'User Website';
        $role_employee->save();
    }
}
