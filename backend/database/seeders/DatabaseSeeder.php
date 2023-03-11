<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email'=> 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);
        User::create([
            'name' => 'Guru',
            'email'=> 'guru@gmail.com',
            'role' => 'guru',
            'password' => bcrypt('guru')
        ]);
    }
}
