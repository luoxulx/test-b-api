<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午5:19
 */
namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Providers\JWT\Lcobucci;
use Tymon\JWTAuth\Providers\JWT\Namshi;

class AuthController extends BaseController
{

    protected $jwt;
    protected $tinyPrivateKey;

    public function __construct(JWTAuth $JWTAuth)
    {
        parent::__construct();
        $this->jwt = $JWTAuth;
        // Description: Key 1560838983378
        $this->tinyPrivateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCYRaOOPjgMKx87
dQmdFsMTNhy9E71f7BhPl4UgP940nqjFvJ/l5pk3gaCE9Zoi4pQiT65jL3klygDS
C2npkqq0RAUhU52USIQIWLZmQYm1tu2sJtMWtkI8kku0bEWgKb22NGtvRUTT9U1j
b51CXGo1D8MYsenB/IIm6Dj/KOpB8766Y9dpuo3PqV/8czBRNuRjjc/gBkPhWq23
GXguCVmhC52S5y9eTSBbmulfQz6d3K5k5bclMq1GiFK8/8rB3Pvk8FwoNLkvi1Me
I/3NOGEnxGnDfjhz1YdqNvU1GxbLWXNlR2rt2YKst4Kw7IDHrJpVwKCoOAIYQ8eX
0Igd0xNNAgMBAAECggEAUzZLKOJrcormKHHO7R+RPyBlGBZ/eLnmlygwQe1lGtBR
Xq2zm8kmlaSq+b3Vm5bCaPWuUNmSlMoNJLvEBzZ1PsmlHA87n9r4/C6ujrbl8H2k
6FzXIiQ7kipIYLKCYgItgDKpO0dZU5NL1TkbcTZbe9+/N/GR0saQwX5KF3ZefedD
xoVuFu8yUVetqObSH5rwzEu3tfADEa/Bm5126NtIjZOErrY3KzE/AI6Gqzk0EL5q
/ki5XOmDD3gQT5qRpzgd0BCfo2XrYPnOW5duUtyJWDfnn/5tWkaVLBsynoBz/321
cjc8JDSVSeNL6PeZi7Zxb8UHkxPz9RhYIqkZm6KRAQKBgQDK3fhX13eDffFU8TDe
cXMA6cj/23cv+VwHhr7AByNCggtm0Bdxjtw9Gjajj8HDvHu4AfMRpLM9MJYTwIym
v+ogdu04l2LbmRK/OduTsGC1rT2eiW8SttPVwuCKPaJPbrJ1SxO6DF96CV1Z1k6a
4ZqDFnhuJFa91zP+OyYbyBRAIQKBgQDAJ1KiEK/wXjMNxTgXPieWKvq5Goixy1qQ
UgOUuVUL5HyH475FwYrOHOlU91mSBrAmfOIJdnhRjnuaufshXUYROX/nKiJY0/Mz
MoM3BDCatDPKuibXOBxU3f0l3I8Tu2UCa5lVY8tsywiwCS7BsQ+UrfV/yOP5uJ4f
t6pvgOAdrQKBgAsQ9rYb+9oBacO/cHIB8EsRdbR3TVYhnSKP+CHTgdnj7ClMmqrI
Jz1yC576fZBm3LzZ5l+FA34IA3fKXiHOgEALHL+kinD+NaaWymKREYV3kM/wIU39
CSs0+TixSgRZPoTldosEl8S5dA0tgpYyTlJuTF19v/mVHrH0mgyT6n7hAoGAGq8b
RZBFrn6WXmot4ORrwOnVCZGKvA3+VJ5fCu81xUIEnSZeTPeUnAzdxkPXN3UgTyf2
h9Pg34qG1bTQEBEQ4uF2RpbOUEGWu1xfZmt5iHJP4u446JhNLufo+LIJWHckjtJ8
Z6RFIqWLXk7YJGO/QylpN0ahihM+Oi9aRsPB270CgYEAsl/2XEVI/CGKHH+aT3A7
3R9kMwGc7pYJRJ2zECkmjcBM7avshIpXkxyyJeSbolpXPVKNyfKoyn1VoU5ATDQb
7wfCYMrmh02f965NyuOqApXHIIeHlVNPPC8dn2phSRZF/YFACXe+pFfT767s9EwG
Zsb9XcnhgEgOTYXQkwqfjFI=
-----END PRIVATE KEY-----
EOD;

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

    public function generateTinyToken()
    {

        return $this->response->json(['token'=>111]);
    }
}
