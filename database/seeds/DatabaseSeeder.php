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
    }
}
