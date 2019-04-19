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

    public function index()
    {
        return $this->response->collection($this->user->paginate(), new UserTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->user->getById($id), new UserTransformer());
    }

    public function store()
    {
        $param = request()->only(['nickname','name','email','password','avatar','introduction','is_admin']);

        return $this->response->withCreated($this->user->create($param), new UserTransformer());
    }

    public function update(int $id)
    {
        $param = request()->only(['nickname','name','email','password','avatar','introduction','is_admin']);

        $this->user->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->user->destroy($id);

        return $this->response->json();
    }

}
