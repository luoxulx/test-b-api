<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/18
 * Time: 下午4:46
 */

namespace App\Http\Controllers\Api\V1;


class ReplyController extends BaseController
{


    public function store()
    {
        return $this->response->withForbidden();
    }
}
