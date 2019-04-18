<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:50
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\TagRepository;

class TagController extends BaseController
{

    protected $tag;

    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();
        $this->tag = $tagRepository;
    }
}
