<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCosplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosplays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('image_id');
            $table->text('thumbnail_url');
            $table->text('origin_url');
            $table->string('action')->default('created'); // created | saved | deleted
            $table->integer('likes')->default(0)->nullable();
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
        Schema::dropIfExists('cosplays');
    }
}
