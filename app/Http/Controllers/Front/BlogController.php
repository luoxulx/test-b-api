<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:14
 */

namespace App\Http\Controllers\Front;


class BlogController extends FrontController
{

    public function index()
    {
        return view('front.blog.index');
    }
}
