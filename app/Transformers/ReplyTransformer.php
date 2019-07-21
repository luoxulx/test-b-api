<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/19
 * Time: 下午3:49
 */

namespace App\Transformers;

use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    public function transform(Reply $reply)
    {
        return $reply->attributesToArray();
    }
}
