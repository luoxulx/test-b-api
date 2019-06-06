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
        // web hook: 14k-lnmpa
        $param = request()->post();
        if (! $param || ! request()->hasHeader('X-Hub-Signature')) {
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
            exec('cd /var/web/lnmpa.top/ && git pull 2>&1', $result);

            return response()->json(['data'=>$result, 'message'=>'sha1 error']);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function buildVueCil()
    {
        // web hook: 14k-lnmpa-web
        $param = request()->post();
        if (! $param || ! request()->hasHeader('X-Hub-Signature')) {
            throw new \Exception('params error', 400);
        }

        $secret = 'frankenstein-14k';
        $githubSign = request()->header('X-Hub-Signature');
        $hash = 'sha1='.hash_hmac('sha1', file_get_contents('php://input'), $secret);

        if (strcmp($githubSign, $hash) === 0) {
            return response()->json(['data'=>$param,'acr'=>'X-Hub-Signature=false']);
        } else {
            set_time_limit(180);
            // php-fpm 用户就是 lx，所以不用切换用户, 只要没有新增 package，就不需要 npm install
            exec('cd /var/web/14k-lnmpa-web/ && git pull && rm -rf dist/ && npm run build:prod 2>&1', $result);

            return response()->json(['data'=>$result, 'message'=>'sha1 error']);
        }
    }
}
