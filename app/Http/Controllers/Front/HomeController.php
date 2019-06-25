<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/15
 * Time: 下午9:07
 */
namespace App\Http\Controllers\Front;

use App\Repositories\LinkRepository;

class HomeController extends FrontController
{

    public function index(LinkRepository $linkRepository)
    {

        $bingPic = cache('home_bing_pic_8_num');
        $allPics = cache('all_info_of_bing_pic');
        $links = cache('home_foot_links');

        if (! $links) {
            $links = $linkRepository->all(['url','name','desc']);
            cache(['home_foot_links' => $links], 1440);
        }

        if (! $bingPic) {
            // n，必要参数。这是输出信息的数量。比如n=1，即为1条，以此类推，至多输出8条。
            $param['n'] = 8;
            $param['format'] = 'js';
            $param['idx'] = 0;

            $defaultUrl = 'https://cn.bing.com/th?id=OHR.FireIce_ZH-CN2924097132_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp';

            $uri = config('app.14k.bing_uri');

            $response = curl($uri, ['query'=>$param], 'get');

            $allPics = [];
            $bingPic = [];
            foreach ($response['images'] as $key => $val) {
                $allPics[$key]['startdate'] = $val['startdate'];
                $allPics[$key]['copyright'] = $val['copyright'];
                $allPics[$key]['copyrightlink'] = $val['copyrightlink'];
                $allPics[$key]['url'] = $val['url'];
                $allPics[$key]['real_url'] = $val['url'] ? config('app.14k.bing_host') . $val['url'] : $defaultUrl;

                $bingPic[$key] = $val['url'] ? config('app.14k.bing_host') . $val['url'] : $defaultUrl;
            }

            cache(['all_info_of_bing_pic'=>$allPics], 1440);
            cache(['home_bing_pic_8_num'=>$bingPic], 1440);
            unset($response);
        }
        shuffle($bingPic);

        return view('front.home.index', ['bingPic'=>$bingPic, 'allPics'=>$allPics, 'links'=>$links]);
    }
}
