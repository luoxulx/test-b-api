<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/22
 * Time: 上午10:23
 */

namespace App\Http\Controllers\Api\V1;

use App\Libraries\FileManager;
use App\Repositories\FileRepository;
use App\Transformers\FileTransformer;

class FileController extends BaseController
{

    protected $file;
    protected $fileManager;

    public function __construct(FileRepository $fileRepository, FileManager $fileManager)
    {
        parent::__construct();
        $this->file = $fileRepository;
        $this->fileManager = $fileManager;
    }

    public function index()
    {
        return $this->response->collection($this->file->paginate(), new FileTransformer());
    }

    public function destroy(int $id)
    {
        $this->file->destroy($id);

        return $this->response->json();
    }

    // 普通上传
    public function upload()
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $this->fileManager->store($file, $dir);

        return $this->response->withCreated($this->file->create($data), new FileTransformer());
    }

    // 扩展包，上传 压缩 水印
    public function resizeUpload()
    {
        $dir = request()->post('dir', 'temp');
        $resize = boolval(request()->post('resize', false));

        $data = $this->fileManager->storeByIntervention($dir, $resize);

        return $this->response->withCreated($this->file->create($data), new FileTransformer());
    }
}
