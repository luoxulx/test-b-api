<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\Models\User::truncate();
        \App\Models\User::create([
            'name' => 'lx',
            'email' => 'lx@lx.com',
            'is_admin' => 1,
            'introduction' => '滚马网络---测试',
            'avatar' => 'http://duoke3-image.oss-cn-hangzhou.aliyuncs.com/test/test/duoke-aaa.png',
            'password' => 'aaaaaa'
        ]);

    }
}
