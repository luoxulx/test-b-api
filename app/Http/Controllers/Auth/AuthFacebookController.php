<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/31
 * Time: 上午11:29
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthFacebookController extends Controller
{

    /**
     * @return mixed
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
        dd($user);
    }
}
