<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("estate_type_id")->nullable();
            $table->string("estate_id")->nullable();
            $table->string("estate_location_type_id")->nullable();
            $table->string("city_id")->nullable();
            $table->string("social_id")->nullable();
            $table->string("allocate")->nullable();
            $table->string("description")->nullable();
            $table->string("result")->nullable();

            $table->string("result_date")->nullable();
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
        Schema::dropIfExists('posters');
    }
}
