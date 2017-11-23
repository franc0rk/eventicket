<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event_types = ['Cultural','Deportivo','Musical'];

        foreach ($event_types as $event_type) {
            factory(\App\EventType::class)->create(
                ['name' => $event_type]
            );
        }
    }
}
