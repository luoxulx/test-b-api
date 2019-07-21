<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/19
 * Time: 下午3:48
 */

namespace App\Repositories;


use App\Models\Reply;

use App\Support\BaiduIpLocation;

class ReplyRepository extends BaseRepository
{

    public function __construct(Reply $reply)
    {
        $this->model = $reply;
    }

    /**
     * @param $input
     * @return Reply
     * @throws \Exception
     */
    public function create($input)
    {
        try {
            $this->beginTransaction();

            $ip = getClientIp();
            $address = (new BaiduIpLocation())->getIpLocation($ip);
            $input['user_id'] = 0;
            $input['origin'] = '来自【'.$address.'】的网友';

            $this->model->fill($input);

            $this->model->save();

            return $this->model;
        } catch (\Exception $exception) {
            $this->rollback();

            throw new \Exception($exception->getMessage() ?? 'Unknown Error', 400);
        }
    }
}
