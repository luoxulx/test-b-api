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
        $users = [
            [
                'name' => 'lx',
                'email' => 'lx@lx.com',
                'is_admin' => 1,
                'introduction' => 'xxx',
                'avatar' => 'https://www.lnmpa.top/images/pic/default-avatar.jpg',
                'password' => 'aaaaaa'
            ]
        ];
        \App\Models\User::insert($users);

        \App\Models\Link::truncate();
        $links = [
            [
                'name' => 'Linux中国',
                'url' => 'https://linux.cn',
                'desc' => 'Linux 中国◆开源社区',
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now()
            ],
            [
                'name' => '孟坤博客',
                'url' => 'https://mkblog.cn',
                'desc' => '孟坤博客 | 每天进步一点点',
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now()
            ]
        ];
        \App\Models\Link::insert($links);
    }
}
