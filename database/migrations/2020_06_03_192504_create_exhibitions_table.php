<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('place_uuid');
            $table->foreign('place_uuid')->references('uuid')->on('places');
            $table->string('slug', 255);
            $table->string('title', 255);
            $table->date('began_at');
            $table->date('ended_at');
            $table->text('description');
            $table->string('link', 255)->nullable();
            $table->decimal('price', 13, 2)->nullable();
            $table->boolean('is_published')->default(false);
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
        Schema::dropIfExists('exhibitions');
    }
}
