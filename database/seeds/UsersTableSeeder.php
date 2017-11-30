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
            'email' => 'admin@eventicket.app',
            'user_type_id' => 1,
        ]);

        factory(\App\User::class)->create([
                'email' => 'client@eventicket.app',
                'user_type_id' => 2,
            ]
        );

        factory(\App\User::class, 10)->create();
    }
}
