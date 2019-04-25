<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/25
 * Time: 下午3:20
 */

namespace App\Repositories;


use App\Models\Video;

class VideoRepository extends BaseRepository
{

    public function __construct(Video $video)
    {
        $this->model = $video;
    }
}
