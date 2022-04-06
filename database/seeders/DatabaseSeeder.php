<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        $user = User::create([
           'name' => 'Task',
           'email' => 'task@mail.io',
           'password' => Hash::make('task'),
        ]);

        $user->assignRole('administrator');

        $user->save();

    }
}
