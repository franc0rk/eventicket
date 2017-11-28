<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email' => 'admin@eventicket.me',
            'user_type_id' => 1
        ]);

        factory(\App\User::class, 10)->create();
    }
}
