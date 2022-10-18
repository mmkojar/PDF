<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::select('id')->where('name', 'super-admin')->first();
        $adminRole = Role::select('id')->where('name', 'admin')->first();

        $admin1 = User::create([
            'name' => 'mmk',
            'email' => 'mmk@gmail.com',            
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
        ]);
        $admin2 = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),            
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);

        $admin1->roles()->attach($superAdminRole);
        $admin2->roles()->attach($adminRole);
    }
}
