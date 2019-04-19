<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:23
 */

namespace App\Transformers;


use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{

    public function transform(File $file)
    {
        return $file->attributesToArray();
    }
}
