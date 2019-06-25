<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/24
 * Time: 下午1:38
 */

namespace App\Transformers;


use App\Models\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{

    public function transform(Link $link)
    {
        return $link->attributesToArray();
    }
}
