<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesEnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles_en', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id', false, true)->comment('关联主表 id');
            $table->string('title', 225)->nullable();
            $table->string('source', 225)->nullable();
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();

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
        Schema::dropIfExists('articles_en');
    }
}
