<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDictionaryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('dictionary_id');
            $table->integer('locale');

            $table->string('name');

            $table->unique(['dictionary_id','locale']);

            $table->foreign('dictionary_id')->references('id')->on('dictionaries')->onDelete('cascade');
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
        Schema::dropIfExists('dictionary_translations');
    }
}
