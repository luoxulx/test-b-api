<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/11
 * Time: 下午1:42
 */

namespace App\Http\Controllers\Api\Vultr;


use GuzzleHttp\Client;

class BaseController extends \App\Http\Controllers\Api\V1\BaseController
{

    protected $client;
    protected $apiKey;

    public function __construct()
    {
        parent::__construct();
        $config = [
            'timeout' => 20,
            'base_uri' => 'https://api.vultr.com'
        ];

        $this->apiKey = config('app.14k.vultr_api_key');
        $this->client = new Client($config);
    }

    /**
     * @param string $uri
     * @param array $data
     * @param string $method
     * @return mixed
     */
    protected function curlVultr(string $uri, array $data = [], string $method = 'get')
    {
        $response = null;

        if (! \in_array('headers', $data, true)) {
            $data['headers'] = ['API-Key' => $this->apiKey];
        }

        try {
            switch (strtoupper($method)) {
                case 'GET':
                    $response = $this->client->get($uri, $data);
                    break;
                case 'POST':
                    $response = $this->client->post($uri, $data);
                    break;
                case 'PUT':
                    $response = $this->client->put($uri, $data);
                    break;
                case 'DELETE':
                    $response = $this->client->delete($uri, $data);
                    break;
                case 'HEAD':
                    $response = $this->client->head($uri, $data);
                    break;
                case 'PATCH':
                    $response = $this->client->patch($uri, $data);
                    break;
                default:
                    return $this->response->setHttpCode(400)->withError('Method Not Allowed');
            }

            return $this->response->json(['data'=>json_decode($response->getBody()->getContents(), true)]);

        } catch (\Exception $exception) {
            $code = $exception->getCode();

            return $this->response->setHttpCode($code)->withError($exception->getMessage());
        }
    }

}
