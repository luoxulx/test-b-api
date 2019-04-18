<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:21
 */

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function __construct(Category $category)
    {
        $this->model = $category;
    }
}
