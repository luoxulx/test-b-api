<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/5/14
 * Time: 下午2:33
 */

namespace App\Repositories;


use App\Models\Feedback;

class FeedbackRepository extends BaseRepository
{
    public function __construct(Feedback $feedback)
    {
        $this->model = $feedback;
    }
}
