<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/9
 * Time: 下午5:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ArticleEn extends Model
{
    protected $table = 'articles_en';

    protected $fillable = [
        'article_id', 'title', 'source', 'description', 'content'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
