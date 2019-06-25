<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/24
 * Time: 下午1:38
 */

namespace App\Models;


class Link extends BaseModel
{

    protected $fillable = [
        'url',
        'name',
        'desc',
    ];
}
