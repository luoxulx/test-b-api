<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:34
 */

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    public function transform(Comment $comment)
    {
        $data = $comment->attributesToArray();
        $data['article_title'] = $comment->article()->value('title');
        $data['replies'] = $comment->replies()->select(['id','nickname','content','origin','created_at'])->get();

        return $data;
    }
}
