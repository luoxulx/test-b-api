<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/14
 * Time: 下午2:34
 */

namespace App\Transformers;


use App\Models\Feedback;
use League\Fractal\TransformerAbstract;

class FeedbackTransformer extends TransformerAbstract
{
    public function transform(Feedback $feedback)
    {
        return $feedback->attributesToArray();
    }
}
