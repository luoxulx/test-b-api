<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:45
 */

namespace App\Models;

use App\Support\BaiduTranslate;
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
        'title2', // 临时字段
        'slug',
        'source',
        'description',
        'thumbnail',
        'content',
        'published_at',
    ];



    public function setPublishedAtAttribute($value)
    {
        $value ? $this->attributes['published_at'] = $value : $this->attributes['published_at'] = date('Y-m-d H:i:s');
    }

    // 为了方便将中文=>slug，需要 title2 翻译下，做个转换
    public function setTitleAttribute($title)
    {
        $title2 = $title;

        if (\strlen($title) !== mb_strlen($title)) {
            $title2 = (new BaiduTranslate()) ->translate($title, 'auto', 'en');
        }

        $this->attributes['title2'] = $title2;
        $this->attributes['title'] = $title;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title2'
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
