<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserType::class)->create(
            ['name' => 'admin']
        );

        factory(App\UserType::class)->create(
            ['name' => 'client']
        );
    }
}
