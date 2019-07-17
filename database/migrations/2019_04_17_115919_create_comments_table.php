<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, true)->default(0);
            $table->integer('article_id', false, true)->default(1);
            $table->string('nickname', 128)->nullable()->comment('guest nickname');
            $table->mediumText('content')->nullable()->comment('comment content');
            $table->mediumText('origin')->nullable()->comment('client origin');
            $table->mediumText('user_agent')->nullable()->comment('client user_agent');

            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `comments` comment 'comments table评论'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
