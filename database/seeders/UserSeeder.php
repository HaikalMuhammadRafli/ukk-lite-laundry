<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = '450';
        $input['name'] = 'cashier';
        $input['email'] = 'cashier@gmail.com';
        $input['password'] = Hash::make($password);
        $input['outlet_id'] = 1;
        $input['role'] = 'cashier';
        User::create($input);

        $input2['name'] = 'admin';
        $input2['email'] = 'admin@gmail.com';
        $input2['password'] = Hash::make($password);
        $input2['outlet_id'] = 1;
        $input2['role'] = 'admin';
        User::create($input2);

        $input3['name'] = 'owner';
        $input3['email'] = 'owner@gmail.com';
        $input3['password'] = Hash::make($password);
        $input3['outlet_id'] = 1;
        $input3['role'] = 'owner';
        User::create($input3);
    }
}
