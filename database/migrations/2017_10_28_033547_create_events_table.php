<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_type_id');
            $table->unsignedInteger('place_id');
            $table->unsignedInteger('state_id')->default(1);
            $table->string('name');
            $table->mediumText('description');
            $table->string('image_cover');
            $table->string('image_thumbnail');
            $table->dateTime('date');

            $table->foreign('event_type_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
