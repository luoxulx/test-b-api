<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/3
 * Time: 下午5:02
 */

namespace App\Http\Controllers;


class WebhookController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function pull()
    {
        // webhooks
        $param = request()->post();
        $headers = request()->header();
        if (! $param || ! $headers) {
            throw new \Exception('params error', 400);
        }

        $secret = 'frankenstein-14k';
        $githubSign = $headers['x-hub-signature'][0];
        $hash = 'sha1='.hash_hmac('sha1', file_get_contents('php://input'), $secret);

        if (strcmp($githubSign, $hash) === 0) {
            return response()->json($param);
        } else {
            set_time_limit(120);
            // php-fpm 用户就是 lx，所以不用切换用户
            shell_exec(base_path('pull.sh'));

            return response()->json(['data'=>'sb', 'message'=>'sha1 error']);
        }
    }
}
