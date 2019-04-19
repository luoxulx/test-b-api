<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:22
 */

namespace App\Repositories;


use App\Models\File;

class FileRepository extends BaseRepository
{

    public function __construct(File $file)
    {
        $this->model = $file;
    }
}
