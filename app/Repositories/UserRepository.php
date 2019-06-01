<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/16
 * Time: 下午8:35
 */
namespace App\Repositories;

use App\Models\GithubUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    protected $githubUser;

    public function __construct(User $user, GithubUser $githubUser)
    {
        $this->model = $user;
        $this->githubUser = $githubUser;
    }

    public function me()
    {
        return Auth::user();
    }

    public function getByGithubId($githubId)
    {
        return $this->githubUser->where(['id'=>$githubId])->first();
    }

}
