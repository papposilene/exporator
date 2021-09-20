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
            $table->string('slug', 255)->unique();
            $table->string('name', 255)->unique();
            $table->boolean('is_open')->default(true);
            $table->text('address');
            $table->text('city');
            $table->uuid('country_cca3');
            $table->foreign('country_cca3')->references('cca3')->on('countries');
            $table->double('lat');
            $table->double('lon');
            $table->string('link', 255);
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
