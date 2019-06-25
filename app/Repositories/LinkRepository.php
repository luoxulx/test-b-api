<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/24
 * Time: 下午1:38
 */

namespace App\Repositories;


use App\Models\Link;

class LinkRepository extends BaseRepository
{

    public function __construct(Link $link)
    {
        $this->model = $link;
    }

    public function all($columns = array('*'))
    {
        return $this->model->orderBy('updated_at', 'desc')->select($columns)->get();
    }
}
