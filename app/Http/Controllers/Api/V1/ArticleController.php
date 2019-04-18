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

class ArticleController extends BaseController
{

    protected $article;

    public function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->article = $articleRepository;
    }
}
