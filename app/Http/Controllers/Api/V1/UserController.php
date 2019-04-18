<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午4:58
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;

class UserController extends BaseController
{

    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->user = $userRepository;
    }

    public function me()
    {
        return $this->response->item($this->user->me(), new UserTransformer());
    }
}
