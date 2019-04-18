<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:45
 */

namespace App\Models;


use Illuminate\Support\Str;

class Article extends BaseModel
{

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

    protected $casts = [
        'more' => 'json'
    ];


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->setUniqueSlug($value, Str::random(12));
    }

    private function setUniqueSlug($value, $extra)
    {
        $slug = Str::slug($value);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($slug, (int) $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
