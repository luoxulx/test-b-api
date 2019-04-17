<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午5:20
 */
namespace App\Http\Controllers\Api\V1;

use League\Fractal\Manager;
use App\Support\Response;
use App\Support\Transform;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    protected $response;

    public function __construct()
    {
        $manager = new Manager();

        $this->response = new Response(response(), new Transform($manager));
    }

}
