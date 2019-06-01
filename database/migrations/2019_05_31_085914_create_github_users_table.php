<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGithubUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->default(0)->comment('bind user, one-one');
            $table->string('login', 64);
            $table->string('token', 225)->nullable();
            $table->string('name', 64);
            $table->string('nickname', 64)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('avatar')->nullable();
            $table->integer('public_repos', false, true)->default(0);
            $table->integer('public_gists', false, true)->default(0);
            $table->integer('followers', false, true)->default(0);
            $table->integer('following', false, true)->default(0);
            $table->string('url', 225)->nullable();
            $table->string('html_url', 225)->nullable();
            $table->string('followers_url', 225)->nullable();
            $table->string('subscriptions_url', 225)->nullable();
            $table->string('organizations_url', 225)->nullable();
            $table->string('repos_url', 225)->nullable();
            $table->string('received_events_url', 225)->nullable();
            $table->string('blog', 225)->nullable();
            $table->string('location', 225)->nullable();
            $table->string('hireable', 225)->nullable();
            $table->string('bio', 225)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_users');
    }
}
