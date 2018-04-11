<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Locations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('ref_uuid');
            $table->unique('ref_uuid');

            $table->string('name');
            $table->string('description')->nullable()->default(null);;
            $table->string('lat')->nullable()->default(null);
            $table->string('lon')->nullable()->default(null);;

            $table->string('img_path');

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
        Schema::drop('locations');
    }
}
