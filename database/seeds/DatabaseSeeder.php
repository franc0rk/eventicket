<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(EventTypesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
    }
}
