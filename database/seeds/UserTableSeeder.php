<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = \App\Role::where('name', 'admin')->first();
        $role_kepala  = \App\Role::where('name', 'kepala')->first();
        $role_user  = \App\Role::where('name', 'user')->first();

        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@mail.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $kepala = new \App\User();
        $kepala->name = 'Kepala UPT';
        $kepala->email = 'kepala@mail.com';
        $kepala->password = bcrypt('secret');
        $kepala->save();
        $kepala->roles()->attach($role_kepala);

        $kepala = new \App\User();
        $kepala->name = 'Rafii';
        $kepala->email = 'piping@mail.com';
        $kepala->password = bcrypt('secret');
        $kepala->save();
        $kepala->roles()->attach($role_user);
    }
}
