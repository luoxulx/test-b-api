<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:52
 */

namespace App\Models;


class Comment extends BaseModel
{

    protected $fillable = [
        'user_id',
        'article_id',
        'nickname',
        'content',
        'origin',
        'user_agent'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
