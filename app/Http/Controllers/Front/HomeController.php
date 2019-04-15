<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:07
 */
namespace App\Http\Controllers\Front;

class HomeController extends FrontController
{

    public function index()
    {
        return view('front.home.index');
    }
}
