<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:45
 */

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class Article extends BaseModel
{

    use Sluggable;

    protected $fillable = [
        'category_id',
        'user_id',
        'is_draft',
        'view_count',
        'title',
        'slug',
        'source',
        'description',
        'thumbnail',
        'content',
    ];

//    protected function setIsDraftAttribute($value)
//    {
//        $this->attributes['is_draft'] = $value ? 1 : 0;
//    }
//
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function getIsDraftAttribute($value)
    {
        return $value ? true : false;
    }

    public function en()
    {
        return $this->hasOne(ArticleEn::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
}
