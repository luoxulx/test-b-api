<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname',100)->default('')->comment('账户昵称');
            $table->string('name', 50)->unique()->comment('账户名称,可用作登录');
            $table->string('email', 128)->unique()->comment('账户email,可用作登录');
            $table->string('password');
            $table->string('avatar',200)->nullable()->comment('用户头像链接');
            $table->mediumText('introduction')->nullable();
            $table->tinyInteger('is_admin', false, true)->default(0);
            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `users` comment 'users table'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
