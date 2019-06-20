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

    public function paginate()
    {
        $perPage = request()->get('per_page', 10);

        return $this->model->orderBy('updated_at', 'desc')->select(['id','category_id','user_id','is_draft','view_count','title','source','description','thumbnail','updated_at'])->paginate($perPage);
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

    /**
     * @param $input
     * @return mixed
     * @throws \Exception
     */
    public function create($input)
    {
        try {
            $this->beginTransaction();
            $this->model->fill($input);

            $this->model->save();

            if (! isset($input['tags'])) {
                $input['tags'] = [];
            }
            if (! isset($input['en'])) {
                $input['en'] = [];
            }
            $this->model->tags()->sync($input['tags']);
            $this->model->en()->create($input['en']);

            $this->commit();
            return $this->model;
        } catch (\Exception $exception) {
            $this->rollback();
            throw new \Exception($exception->getMessage() ?? 'store error. ', 400);
        }
    }

    /**
     * @param int $id
     * @param $input
     * @return bool
     * @throws \Exception
     */
    public function update(int $id, $input)
    {
        try {
            $this->beginTransaction();

            $this->model = $this->getById($id);
            $this->model->fill($input);

            if (isset($input['tags'])) {
                $this->model->tags()->sync($input['tags']);
            }
            if (isset($input['en'])) {
                $this->model->en()->update($input['en']);
            }

            $this->model->save();

            $this->commit();
            return true;
        } catch (\Exception $exception) {
            $this->rollback();
            throw new \Exception($exception->getMessage() ?? 'update error', 400);
        }

    }

    // front
    public function archives()
    {
        $archives = $this->model->orderBy('published_at', 'desc')->groupBy('published_at')->select(['published_at'])->get();
        $arg = [];
        foreach ($archives as $key=>$item) {
            $arg[$key]['timestamp'] = strtotime($item->published_at);
            $arg[$key]['text'] = date('F Y', strtotime($item->published_at));
        }

        return $arg;
    }

    public function pageList($month = null)
    {
        $perPage = request()->get('per_page', 10);

        $condition = [
            'is_draft' => 0
        ];
        if ($month !== null) {
            $list = $this->model->where($condition)->where('published_at', '>=', $month.'-01')->where('published_at', '<=', $month.'-31')->orderBy('updated_at', 'desc')->paginate($perPage);
        } else {
            $list = $this->model->where($condition)->orderBy('updated_at', 'desc')->paginate($perPage);
        }

        return $list;
    }

}
