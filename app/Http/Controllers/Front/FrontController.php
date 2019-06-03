<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:06
 */
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{

    public function webhooks()
    {
        $param = request()->post();

        return response()->json($param);
    }
}
