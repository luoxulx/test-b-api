<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:20
 */

namespace App\Repositories;


use App\Models\Tag;

class TagRepository extends BaseRepository
{

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}
