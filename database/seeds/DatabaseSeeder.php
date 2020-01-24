<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * 两个 links 内容
     * seeds file
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
                'avatar' => 'https://net.lnmpa.top/owl/pic/default-avatar.jpg',
                'password' => \Illuminate\Support\Facades\Hash::make('aaaaaa'),
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => \Illuminate\Support\Carbon::now()
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
