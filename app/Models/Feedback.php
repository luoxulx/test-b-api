<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/14
 * Time: 下午2:32
 */

namespace App\Models;


class Feedback extends BaseModel
{
    protected $table = 'feedbacks';
    protected $fillable = [
        'nickname',
        'email',
        'content'
    ];
}
