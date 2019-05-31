<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/29
 * Time: 下午5:41
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class AuthGithubController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        dd($user);

        // $user->token;
    }
}
