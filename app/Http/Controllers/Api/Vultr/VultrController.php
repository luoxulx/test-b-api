<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/11
 * Time: 下午3:35
 */

namespace App\Http\Controllers\Api\Vultr;


class VultrController extends BaseController
{
    public function info()
    {
        $uri = '/v1/account/info';

        return $this->curlVultr($uri);
    }

    public function application()
    {
        $uri = '/v1/app/list';

        return $this->curlVultr($uri);
    }
}
