<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory(10)->create();
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
