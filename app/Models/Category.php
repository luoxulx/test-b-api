<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:48
 */

namespace App\Models;


class Category extends BaseModel
{

    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'thumbnail',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
