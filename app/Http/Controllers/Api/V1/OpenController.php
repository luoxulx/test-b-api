<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:25
 */

namespace App\Http\Controllers\Api\V1;


use App\Libraries\FileManager;
use App\Repositories\FileRepository;
use App\Transformers\FileTransformer;

class OpenController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function upload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $fileManager->store($file, $dir);

        return $this->response->withCreated($fileRepository->create($data), new FileTransformer());
    }

    public function chunk_upload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temps');

        $data = $fileManager->chunkStore($file, $dir);

        var_dump($data);die;
    }
}
