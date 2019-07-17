<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:21
 */

namespace App\Repositories;


use App\Models\Comment;
use App\Support\BaiduIpLocation;

class CommentRepository extends BaseRepository
{

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function commentList($condition)
    {
        $columns = ['id','nickname','content','origin','user_id','article_id','created_at'];
        return $this->model->where($condition)->orderBy('created_at', 'desc')->select($columns)->get();
    }

    public function create($input)
    {
        $ip = $this->getClientIp();
        $address = (new BaiduIpLocation())->getIpLocation($ip);
        $input['user_id'] = 0;
        $input['origin'] = '来自【'.$address.'】的网友';

        $this->model->fill($input);

        $this->model->save();

        return $this->model;
    }


    private function getClientIp()
    {
        $ip = null;

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return is_ip($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $ip;
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return is_ip($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $ip;
        }

        return is_ip($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $ip;
    }

}
