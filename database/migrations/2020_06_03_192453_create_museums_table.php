<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museums', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name', 255);
            $table->text('address');
            $table->double('lat');
            $table->double('lon');
            $table->string('link', 255);
            $table->uuid('country_uuid');
            $table->foreign('country_uuid')->references('uuid')->on('countries');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museums');
    }
}
