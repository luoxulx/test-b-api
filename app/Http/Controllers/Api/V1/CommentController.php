<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:51
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CommentRepository;

class CommentController extends BaseController
{

    protected $comment;

    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct();
        $this->comment = $commentRepository;
    }
}
