<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/14
 * Time: 下午2:30
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\FeedbackRepository;
use App\Transformers\FeedbackTransformer;

class FeedbackController extends BaseController
{
    protected $feedback;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        parent::__construct();
        $this->feedback = $feedbackRepository;
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->feedback->create($param), new FeedbackTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->feedback->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->feedback->destroy($id);

        return $this->response->json();
    }
}
