<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('z11_laravel')->create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_dark');
            $table->string('image_white');
            $table->string('title');
            $table->string('link');
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
        Schema::connection('z11_laravel')->dropIfExists('banners');
    }
}
