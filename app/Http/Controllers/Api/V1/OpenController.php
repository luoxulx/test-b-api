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

    public function webhooks()
    {
        // webhooks
        $param = request()->post();

        return response()->json($param);
    }

    public function upload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $fileManager->store($file, $dir);

        return $this->response->withCreated($fileRepository->create($data), new FileTransformer());
    }

    public function patch_upload(FileManager $fileManager, FileRepository $fileRepository)
    {
        $file = request()->file('file');
        $dir = request()->post('dir', 'temp');

        $data = $fileManager->patchStore($file, $dir);

        return $this->response->json($data);
    }

    /**
     * @param null
     * n，必要参数。这是输出信息的数量。比如n=1，即为1条，以此类推，至多输出8条。
     * format，非必要。返回结果的格式，不存在或者等于xml时，输出为xml格式，等于js时，输出json格
     * idx，非必要。不存在或者等于0时，输出当天的图片，-1为已经预备用于明天显示的信息，1则为昨天的图片，以此类推，idx最多获取到前16天的图片信息
     * @imageHost http://cn.bing.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function pictures()
    {
        $param['n'] = request()->get('n', 1);
        $param['format'] = request()->get('format', 'js');
        $param['idx'] = request()->get('idx', 0);

        $defaultUrl = 'https://cn.bing.com/th?id=OHR.FireIce_ZH-CN2924097132_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp';
        $uri = 'http://cn.bing.com/HPImageArchive.aspx';

        if (! \in_array($param['format'], ['js','xml'])) {
            return $this->response->setHttpCode(422)->json([
                'code' => 422,
                'message' => 'Data validation failed',
                'debug' => 'format='.$param['format'].', The format must be in ["js", "xml"]'
            ]);
        }

        if (strval($param['format']) === 'xml') {
            header('Content-type: text/xml');
            $response = guzzleRequest($uri, ['query'=>$param], 'get');
            echo $response;
            die;
        }

        $response = guzzleRequest($uri, ['query'=>$param], 'get');

        foreach ($response['images'] as $key => $val) {
            $response['images'][$key]['real_url'] = $val['url'] ? 'https://cn.bing.com' . $val['url'] : $defaultUrl;
        }

        return $this->response->json(['data'=>$response]);
    }
}
