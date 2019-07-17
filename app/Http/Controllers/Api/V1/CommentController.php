<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:51
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformer;

class CommentController extends BaseController
{

    protected $comment;

    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct();
        $this->comment = $commentRepository;
    }

    public function index()
    {
        $all = request()->get('all');
        $condition = [
            'article_id' => request()->get('article_id', 1)
        ];
        if ($all) {
            return $this->response->collection($this->comment->commentList($condition), new CommentTransformer());
        }
        return $this->response->collection($this->comment->paginate(), new CommentTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->comment->getById($id), new CommentTransformer());
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->comment->create($param), new CommentTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->comment->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->comment->destroy($id);

        return $this->response->json();
    }
}
