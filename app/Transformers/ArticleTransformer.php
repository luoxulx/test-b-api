<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午9:08
 */

namespace App\Transformers;


use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{

    protected $availableIncludes  = [
        'tags',
        'category'
    ];

    public function transform(Article $article)
    {
        $result = $article->attributesToArray();
        $result['enUS'] = $article->enUS()->select(['title_en','content_en']);
        $result['category_name'] = $article->category()->value('name');
        $result['user_name'] = $article->user()->value('name');

        return $result;
    }

    /**
     * Include Category
     *
     * @param Article $article
     * @return \League\Fractal\Resource\Item
     */
    public function includeCategory(Article $article)
    {
        if ($category = $article->category) {
            return $this->item($category, new CategoryTransformer);
        }
    }
    /**
     * Include Tags
     *
     * @param Article $article
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTags(Article $article): ?\League\Fractal\Resource\Collection
    {
        if ($tags = $article->tags) {
            return $this->collection($tags, new TagTransformer);
        }
    }
}
