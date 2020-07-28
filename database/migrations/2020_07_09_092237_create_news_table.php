<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chanel_id')->nullable();
            $table->string('post_id')->nullable();
            $table->longText('content')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('replies')->default(0);
            $table->integer('active')->default(0);
            $table->string('post_created');
            $table->string('source');
            $table->string('locale');
            $table->string('game');
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
        Schema::dropIfExists('news');
    }
}
