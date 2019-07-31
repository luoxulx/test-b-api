<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:21
 */

namespace App\Repositories;


use App\Mail\CommentNew;
use App\Models\Comment;
use App\Support\BaiduIpLocation;
use Illuminate\Support\Facades\Mail;

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

    /**
     * @param $input
     * @return Comment
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

            // Mail::to('luoxulx@live.com')->send(new CommentNew($input));
            $this->commit();

            return $this->model;
        } catch (\Exception $exception) {
            $this->rollback();

            throw new \Exception($exception->getMessage() ?? 'Unknown Error', 400);
        }
    }

}
