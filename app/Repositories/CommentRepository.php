<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:21
 */

namespace App\Repositories;


use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}
