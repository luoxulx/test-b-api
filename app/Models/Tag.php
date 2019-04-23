<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:51
 */

namespace App\Models;


class Tag extends BaseModel
{

    protected $fillable = [
        'name',
        'color',
        'style',
        'description',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
