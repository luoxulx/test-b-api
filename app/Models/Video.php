<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/25
 * Time: 下午3:15
 */

namespace App\Models;


class Video extends BaseModel
{
    protected $table = 'videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'user_id',
        'view_count',
        'original_name',
        'mime',
        'size',
        'real_path',
        'media_url',
        'media_pic',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
