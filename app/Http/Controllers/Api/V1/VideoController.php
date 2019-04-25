<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/25
 * Time: 下午3:22
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\VideoRepository;
use App\Transformers\VideoTransformer;

class VideoController extends BaseController
{

    protected $video;

    public function __construct(VideoRepository $videoRepository)
    {
        parent::__construct();
        $this->video = $videoRepository;
    }

    public function index()
    {
        return $this->response->collection($this->video->paginate(), new VideoTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->video->getById($id), new VideoTransformer());
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->video->create($param), new VideoTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->video->update($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->video->destroy($id);

        return $this->response->json();
    }
}
