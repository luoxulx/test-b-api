<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/22
 * Time: 上午10:23
 */

namespace App\Http\Controllers\Api\V1;


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
}
