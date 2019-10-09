<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午5:19
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    protected $jwt;

    public function __construct(JWTAuth $JWTAuth)
    {
        parent::__construct();
        $this->jwt = $JWTAuth;
    }

    public function login(Request $request)
    {
        $param = $request->only(['password', 'login_name']);
        $condition = [
            'password' => $param['password'],
            'is_admin' => 1
        ];
        if (strpos($param['login_name'], '@') !== false) {
            $condition['email'] = $param['login_name'];
        } else {
            $condition['name'] = $param['login_name'];
        }

        $token = $this->jwt->attempt($condition);

        if (! $token) {
            return $this->response->withUnauthorized('账号或密码错误');
        }

        $data = [
            'type' => 'bearer',
            'token' => $token,
            'expires_in' => $this->jwt->factory()->getTTL(),
            'user' => $this->jwt->user()
        ];
        return $this->response->json(['data' => $data]);
    }

    public function refresh()
    {
        $data = [
            'type' => 'bearer',
            'token' => $this->jwt->refresh(),
            'expires_in' => $this->jwt->factory()->getTTL(),
            // 'user' => $this->jwt->user()
        ];
        return $this->response->json($data);
    }


    public function logout()
    {
        Auth::guard('api')->logout();

        return $this->response->json(['message'=>'successful']);
    }
}
