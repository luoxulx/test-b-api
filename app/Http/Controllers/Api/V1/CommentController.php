<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/18
 * Time: 下午7:51
 */

namespace App\Http\Controllers\Api\V1;


use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformer;

class CommentController extends BaseController
{

    protected $comment;

    public function __construct(CommentRepository $commentRepository)
    {
        parent::__construct();
        $this->comment = $commentRepository;
    }

    public function index()
    {
        return $this->response->collection($this->comment->paginate(), new CommentTransformer());
    }

    public function show(int $id)
    {
        return $this->response->item($this->comment->getById($id), new CommentTransformer());
    }

    public function store()
    {
        $param = request()->all();

        return $this->response->withCreated($this->comment->create($param), new CommentTransformer());
    }

    public function update(int $id)
    {
        $param = request()->all();

        $this->comment->updateColumn($id, $param);

        return $this->response->json();
    }

    public function destroy(int $id)
    {
        $this->comment->destroy($id);

        return $this->response->json();
    }

    public function clientStore() {}

    /**
     * @return string
     * @throws \Exception
     */
    private function clientBrowser ()
    {
        if (! empty($_SERVER['HTTP_USER_AGENT'])) {
            $browser = $_SERVER['HTTP_USER_AGENT'];

            if (strpos($browser, 'MSIE' !== false || strpos($browser, 'rv:11.0'))) {
                return 'MSIE';
            }
            if (strpos($browser, 'Firefox') !== false) {
                return 'Firefox';
            }
            if (strpos($browser, 'Chrome') !== false) {
                return 'Chrome';
            }
            if (strpos($browser, 'Opera') !== false) {
                return 'Opera';
            }
            if (strpos($browser, 'Chrome') !== false && strpos($browser, 'Safari') !== false) {
                return 'Safari';
            }
            if (strpos($browser, 'Chrome') !== false) {
                return 'Chrome';
            }
            if (strpos($browser, 'Chrome') !== false) {
                return 'Chrome';
            }

            return 'xx?';
        }

        throw new \Exception('HTTP_USER_AGENT ERROR. ', 400);
    }


    private function clientAddr()
    {
        $ip = false;

        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ips = explode (',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }

            for ($i = 0; $i < count($ips); $i++) {
                if (! preg_match ("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }

        $ip = $ip ?? $_SERVER['REMOTE_ADDR'];

        $cityInfo = json_decode(file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip), true);

        $cityName = '火星';
        if (isset($cityInfo['code']) && $cityInfo['code'] == 0) {
            $cityName = $cityInfo['data']['city'];
        }

        return $cityName;
    }
}
