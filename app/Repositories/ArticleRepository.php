<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:19
 */

namespace App\Repositories;


use App\Models\Article;

class ArticleRepository extends BaseRepository
{

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getBySlug($slug)
    {
        $condition = [
            'slug' => $slug,
            'is_draft' => 0
        ];
        $article = $this->model->where($condition)->firstOrFail();
        $article->increment('view_count');

        return $article;
    }

    public function create($input)
    {
        $this->model->fill($input);

        $this->model->save();

//        if (! isset($input['tags'])) {
//            $input['tags'] = [];
//        }
        $this->model->tags()->sync($input['tags']);
        $this->model->enUS()->sync();

        return $this->model;
    }

    public function update(int $id, $input)
    {
        $this->model = $this->getById($id);

        $this->model->fill($input);
        if (isset($input['tags'])) {
            $this->model->tags()->sync($input['tags']);
        }

        return $this->model->save();
    }

    /**
     * Sync the tags for the article.
     *
     * @param array $tags
     */
    public function syncTag(array $tags)
    {
        $this->model->tags()->sync($tags);
    }

}
