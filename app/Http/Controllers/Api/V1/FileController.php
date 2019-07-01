<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/22
 * Time: 上午10:23
 */

namespace App\Http\Controllers\Api\V1;

use App\Repositories\FileRepository;
use App\Support\QiniuStorage;
use App\Transformers\FileTransformer;

class FileController extends BaseController
{

    protected $file;
    protected $qiniu;

    public function __construct(FileRepository $fileRepository, QiniuStorage $qiniuStorage)
    {
        parent::__construct();
        $this->file = $fileRepository;
        $this->qiniu = $qiniuStorage;
    }

    public function index()
    {
        return $this->response->collection($this->file->paginate(), new FileTransformer());
    }

    public function uploadToken()
    {
        $key = request()->get('key');
        if ($key !== null) {
            $key .= '/'.date('Y').'/'.date('m').'/'.md5(uniqid().time()).'.png';
        }

        $data = [
            'token' => $this->qiniu->uploadToken($key),
            'key' => $key,
            'uri' => 'https://upload-na0.qiniup.com'
        ];
        return $this->response->json(['data' => $data]);
    }

    public function saveFileInfo()
    {
        $data = request()->all();

        return $this->response->withCreated($this->file->create($data), new FileTransformer());
    }

    public function destory()
    {
        $key = request()->post('key');

        $res = $this->qiniu->delete($key);

        return $this->response->json(['data'=>$res]);
    }
}
