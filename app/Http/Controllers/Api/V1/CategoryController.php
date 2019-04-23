<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:48
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CategoryRepository;
use App\Transformers\CategoryTransformer;

class CategoryController extends BaseController
{

    protected $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->category = $categoryRepository;
    }

    public function index()
    {
        return $this->response->collection($this->category->paginate(), new CategoryTransformer());
    }

    public function all_categories()
    {
        return $this->response->collection($this->category->all(['id','name']), new CategoryTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->category->getById($id), new CategoryTransformer());
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->category->create($param), new CategoryTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->category->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->category->destroy($id);

        return $this->response->json();
    }

    public function batch()
    {
        $ids = request()->json('ids');
        $this->category->batchDestroy($ids);

        return $this->response->json();
    }
}
