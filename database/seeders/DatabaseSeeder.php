<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $roles = ['admin', 'RespoCommunication', 'chefDep1', 'chefDep2', 'chefDep3'];
        // for($i=0;$i<5;$i++){
        //     \App\Models\User::factory(1)->create([
        //         'role' => $roles[array_rand($roles)],
        //         'password' => bcrypt('password')
        //     ]);
        // }

        \App\Models\User::factory(1)->create([
            'role' => 'RespoCommunication',
            'email' => 'communication@gmail.com',
            'password' => bcrypt('password')
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
