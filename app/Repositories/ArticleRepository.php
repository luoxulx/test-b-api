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

        return $this->model->orderBy('created_at', 'desc')->select(['id','category_id','user_id','is_draft','title','source','description','slug','updated_at'])->paginate($perPage);
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

    public function draft($id, $draft)
    {
        $this->model = $this->getById($id);
        $this->model->fill(['is_draft' => $draft]);

        return $this->model->save();
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
            // TODO 默认值 en
            if (!isset($input['en']['title']) || empty($input['en']['title'])) {
                $input['en']['title'] = $input['title'];
            }
            if (!isset($input['en']['source']) || empty($input['en']['source'])) {
                $input['en']['source'] = $input['source'];
            }
            if (!isset($input['en']['description']) || empty($input['en']['description'])) {
                $input['en']['description'] = $input['description'];
            }
            if (!isset($input['en']['content']) || empty($input['en']['content'])) {
                $input['en']['content'] = $input['content'];
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

            if (isset($input['tags']) && !empty($input['tags'])) {
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
            $arg[$key]['date'] = date('Y-m', strtotime($item->published_at));
            $arg[$key]['text'] = date('F Y', strtotime($item->published_at));
        }

        return array_unique($arg, SORT_REGULAR);
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
