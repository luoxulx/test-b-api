<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/25
 * Time: 下午3:19
 */

namespace App\Transformers;


use App\Models\Video;
use League\Fractal\TransformerAbstract;

class VideoTransformer extends TransformerAbstract
{

    public function transform(Video $video)
    {
        $result = $video->attributesToArray();
        $result['category_name'] = $video->category()->value('name');
        $result['user_name'] = $video->user()->value('name');

        return $result;
    }
}
