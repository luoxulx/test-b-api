<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/18
 * Time: 下午4:46
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\ReplyRepository;
use App\Transformers\ReplyTransformer;

class ReplyController extends BaseController
{

    protected $reply;

    public function __construct(ReplyRepository $replyRepository)
    {
        parent::__construct();
        $this->reply = $replyRepository;
    }

    public function store()
    {
        $input = request()->all();
        return $this->response->withCreated($this->reply->create($input), new ReplyTransformer());
    }
}
