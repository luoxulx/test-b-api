<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:50
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\TagRepository;
use App\Transformers\TagTransformer;

class TagController extends BaseController
{

    protected $tag;

    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
    }

    public function index()
    {
        return $this->response->collection($this->tag->paginate(), new TagTransformer());
    }

    public function all_tags()
    {
        return $this->response->collection($this->tag->all(['id','name','color']), new TagTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->tag->getById($id), new TagTransformer());
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->tag->create($param), new TagTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->tag->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->tag->destroy($id);

        return $this->response->json();
    }

    public function batch()
    {
        $ids = request()->json('ids');
        $this->tag->batchDestroy($ids);

        return $this->response->json();
    }
}
