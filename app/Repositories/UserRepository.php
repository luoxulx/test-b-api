<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/16
 * Time: 下午8:35
 */
namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

}
