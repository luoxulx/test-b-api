<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/29
 * Time: 下午5:41
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;

class AuthGithubController extends Controller
{

    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


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
        $githubUser = Socialite::driver('github')->user();

        $user = $this->user->getByGithubId($githubUser->id);

        if (auth()->check()) {
            // 当前用户已通过身份认证
            return redirect()->to('/blog');
        } else {
            if ($user === null) {
                $result = $this->createUserByGithub($githubUser);
                auth()->loginUsingId($result->id);

                return redirect()->to('/blog');
            } else {
                auth()->loginUsingId($user->id);

                return redirect()->to('/blog');
            }
        }
    }

    protected function createUserByGithub($githubUser)
    {
        try {
            // 创建 github&user 用户并登录
            $nowUser = [
                'id' => $githubUser->id,
                'login' => $githubUser->user['login'],
                'token' => $githubUser->token,
                'name' => $githubUser->name,
                'nickname' => $githubUser->nickname,
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
                'public_repos' => $githubUser->user['public_repos'],
                'public_gists' => $githubUser->user['public_gists'],
                'followers' => $githubUser->user['followers'],
                'following' => $githubUser->user['following'],
                'url' => $githubUser->user['url'],
                'html_url' => $githubUser->user['html_url'],
                'followers_url' => $githubUser->user['followers_url'],
                'subscriptions_url' => $githubUser->user['subscriptions_url'],
                'organizations_url' => $githubUser->user['organizations_url'],
                'repos_url' => $githubUser->user['repos_url'],
                'received_events_url' => $githubUser->user['received_events_url'],
                'blog' => $githubUser->user['blog'],
                'location' => $githubUser->user['location'],
                'hireable' => $githubUser->user['hireable'],
                'bio' => $githubUser->user['bio'],
            ];

            $user = [
                'nickname' => $githubUser->nickname,
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'password' => Hash::make(''),
                'avatar' => $githubUser->avatar,
                'introduction' => $githubUser->bio,
                'is_admin' => 0,
            ];

            DB::beginTransaction();
            $userModel = $this->user->create($user);
            $githubUser['user_id'] = $userModel->id;

            DB::table('github_users')->insert($nowUser);

            DB::commit();
            return $userModel;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(400, $exception->getMessage() ?? 'server error. ');
        }
    }
}
