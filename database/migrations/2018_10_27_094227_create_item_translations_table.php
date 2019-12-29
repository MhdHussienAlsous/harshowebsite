<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_translations', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('item_id');
            $table->integer('locale');

            $table->string('title')->nullable();
            $table->string('body')->nullable();;
            $table->integer('user_id')->nullable();;
            $table->integer('views')->nullable();;

            $table->unique(['item_id','locale']);

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('locale')->references('id')->on('languages')->onDelete('cascade');

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
        Schema::dropIfExists('item_translations');
    }
}
