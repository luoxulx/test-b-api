<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->default(0);
            $table->integer('category_id', false, true)->default(0);
            $table->integer('view_count', false, true)->default(0);
            $table->string('size', 32)->nullable();
            $table->string('mine', 64)->nullable();
            $table->string('original_name', 225)->nullable();
            $table->string('real_path', 225)->nullable();

            $table->string('title', 225)->nullable();
            $table->string('description', 225)->nullable();
            $table->string('media_pic', 225)->nullable();
            $table->string('media_url', 225)->nullable();
            $table->mediumText('more', 225)->nullable()->comment('额外字段');

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
        Schema::dropIfExists('videos');
    }
}
