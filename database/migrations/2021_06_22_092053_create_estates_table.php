<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->integer("estate_type_id")->nullable();
            $table->integer("building_type_id")->nullable();
            $table->integer("city_id")->nullable();
            $table->integer("location_id")->nullable();
            $table->integer("user_id")->nullable();
            $table->string("owner_name")->nullable();
            $table->string("owner_phone")->nullable();
            $table->string("area")->nullable();
            $table->string("building_area")->nullable();
            $table->string("building_date")->nullable();
            $table->string("price")->nullable();
            $table->string("length")->nullable();
            $table->string("width")->nullable();
            $table->string("description")->nullable();
            $table->string("address")->nullable();
            $table->string("floors_count")->nullable();
            $table->string("module")->nullable();
            $table->string("floors")->nullable();
            $table->string("other_options")->nullable();

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
        Schema::dropIfExists('estates');
    }




}
