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

    public function __construct(FileRepository $fileRepository)
    {
        parent::__construct();
        $this->file = $fileRepository;
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

    public function upload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $fileManager->store($file, $dir);

        return $this->response->withCreated($fileRepository->create($data), new FileTransformer());
    }

    public function patchUpload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $fileManager->patchStore($file, $dir);

        return $this->response->json($data);
    }
}
