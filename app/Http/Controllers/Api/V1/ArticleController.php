<?php
/** @noinspection LongInheritanceChainInspection */

/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:45
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\ArticleRepository;
use App\Transformers\ArticleTransformer;

class ArticleController extends BaseController
{

    protected $article;
    protected $fields;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->article = $articleRepository;
    }

    public function index()
    {
        return $this->response->collection($this->article->paginate(), new ArticleTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->article->getById($id), new ArticleTransformer(['content']));
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->article->create($param), new ArticleTransformer(['content']));
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->article->update($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->article->destroy($id);

        return $this->response->json();
    }

    public function batch()
    {
        $ids = request()->json('ids');
        $this->article->batchDestroy($ids);

        return $this->response->json();
    }

    public function draft($id)
    {
        $draft = request()->json('draft');

        $this->article->draft($id, $draft);

        return $this->response->json();
    }
}
