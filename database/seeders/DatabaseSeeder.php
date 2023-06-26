<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $roles = ['admin', 'RespoCommunication', 'chefDep', 'employeDep'];
        // $deps = DB::table('Departments')->get();
        // for($i=0;$i<40;$i++){
        //     $selectedRole = rand(0, 3);
        //     $selectedDep = $deps->random();
        //     while ($selectedDep->name == 'blank') {
        //         $selectedDep = $deps->random();
        //     }
        //     $dep = $selectedDep->id;
        //     if ($roles[$selectedRole] == 'admin' || $roles[$selectedRole] == 'RespoCommunication') {
        //         $dep = DB::table('Departments')->where('name', 'blank')->value('id');
        //     }
        //     \App\Models\User::factory(1)->create([
        //         'role' => $roles[$selectedRole],
        //         'department_id' => $dep,
        //         'confirmed' => !!rand(0, 1),
        //         'password' => bcrypt('password'),

        //     ]);
        // }

        // \App\Models\User::factory(1)->create([
        //     'role' => 'RespoCommunication',
        //     'email' => 'communication@gmail.com',
        //     'password' => bcrypt('password')
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // for ($i = 0; $i < 50; $i++) {
        //     \App\Models\ContactMessage::create([
        //         'full_name' => 'Example NAME' . $i,
        //         'email' => 'email' . $i . '@gmail.com',
        //         'objet' => 'Lorem Ipsum Dolor Sit Amet' . $i,
        //         'message' => $i . 'Lorem ipsum dolor sit amet. Cum illum nesciunt et eveniet dolores vel unde galisum aut possimus neque At ratione debitis sed illo sapiente est enim nemo. A harum eius non praesentium quae vel beatae ducimus ut minima incidunt sit nulla debitis non ipsam rerum et dolorem voluptatem. Nam dolores voluptas aut saepe voluptate sed error sint non suscipit magni ea perferendis eligendi est galisum incidunt et fugiat dolor!

        //         Aut voluptatibus suscipit ad blanditiis architecto vel dolores eveniet in debitis deleniti est velit aspernatur quo officia consequatur. Ut voluptatem sapiente sit odit debitis non voluptatum corrupti et minus ipsa et nostrum galisum. Nam amet delectus sit culpa ipsam eos quasi eligendi sed molestiae recusandae ut veniam voluptate. Vel voluptas ullam et doloribus sint et perspiciatis possimus qui officiis omnis est illum ipsum et voluptatibus quidem!

        //         In reiciendis numquam et omnis magnam sit reprehenderit iure. Qui rerum quaerat est reiciendis velit vel tempore quae a neque error. Non sapiente velit et repudiandae excepturi ut minima quia non autem vero sed nobis consequatur est mollitia autem. Aut quaerat fugiat vel consequatur voluptatem ut aspernatur quia et laudantium voluptas aut odit ducimus sit perferendis consequuntur non temporibus optio.'
        //     ]);
        // }

        //     for ($i = 0; $i < 6; ++$i) {
        //         $name = '';
        //         for ($j = 0; $j < 3; ++$j) {
        //             $name .= chr(rand(65, 90));
        //         }
        //         \App\Models\Department::create([
        //             'name' => $name
        //         ]);
        //     }
        //     \App\Models\Department::create([
        //         'name' => 'blank'
        //     ]);

        $deps = DB::table('Departments')->get();
        for($i=0;$i<40;$i++){
            $selectedDep = $deps->random();
            while ($selectedDep->name == 'blank') {
                $selectedDep = $deps->random();
            }
            Document::create([
                'sender' => 'sender ' . $i,
                'receiver' => 'receiver ' . $i,
                'objet' => 'Lorem ipsum dolor sit amet. Cum ' . $i,
                'keywords' => 'k' . $i . ', k' . ($i + 1) . ', k' . ($i + 2),
                'path' => '/lorem/ipsum/' . $i,
                'date_transmission' => Carbon::parse('2022-02-16'),
                'user_id' => '1',
                'department_id' => $selectedDep->id
            ]);
        }
    }
}
