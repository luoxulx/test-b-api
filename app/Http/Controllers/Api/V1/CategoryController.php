<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:48
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CategoryRepository;

class CategoryController extends BaseController
{

    protected $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->category = $categoryRepository;
    }
}
