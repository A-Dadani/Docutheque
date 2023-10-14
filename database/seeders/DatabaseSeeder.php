<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Document;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'blank'
        ]);
        User::create([
            'name' => 'Administrateur Racine',
            'email' => 'racine@gmail.com',
            'password' => bcrypt('Votre_mot_de_passe_ici'),
            'role' => 'admin',
            'department_id' => (DB::table('Departments')->where('name', '=', 'blank')->first())->id,
            'confirmed' => true
        ]);
    }
}
