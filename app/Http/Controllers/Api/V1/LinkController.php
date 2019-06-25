<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/24
 * Time: 下午1:37
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\LinkRepository;
use App\Transformers\LinkTransformer;

class LinkController extends BaseController
{

    protected $link;

    public function __construct(LinkRepository $linkRepository)
    {
        parent::__construct();
        $this->link = $linkRepository;
    }

    public function index()
    {
        return $this->response->collection($this->link->all(), new LinkTransformer());
    }

    public function show($id)
    {
        return $this->response->item($this->link->getById($id), new LinkTransformer());
    }

    public function store()
    {
        $param = request()->all();
        cache()->forget('home_foot_links');

        return $this->response->withCreated($this->link->create($param), new LinkTransformer());
    }

    public function update($id)
    {
        $param = request()->all();
        cache()->forget('home_foot_links');

        $this->link->update($id, $param);

        return $this->response->json();
    }

    public function destroy($id)
    {
        $this->link->destroy($id);

        return $this->response->json();
    }
}
