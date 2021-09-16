<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('name_common_eng', 255);
            $table->string('name_common_fra', 255);
            $table->string('name_official_eng', 255);
            $table->string('name_official_fra', 255);
            $table->string('cca2', 2);
            $table->string('cca3', 3)->index();
            $table->string('region', 255);
            $table->string('subregion', 255)->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->string('flag', 255)->nullable();
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
        Schema::dropIfExists('countries');
    }
}
