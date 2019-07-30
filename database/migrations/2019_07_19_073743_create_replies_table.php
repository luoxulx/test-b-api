<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id', false, true)->default(0);
            $table->integer('comment_id', false, true)->default(0);
            $table->string('nickname', 64)->nullable()->comment('nickname');
            $table->string('content', 252)->nullable()->comment('reply content');
            $table->string('origin', 225)->nullable()->comment('client origin');
            $table->string('user_agent', 252)->nullable()->comment('client agent');
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
        Schema::dropIfExists('replies');
    }
}
