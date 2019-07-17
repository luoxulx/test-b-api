<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/17
 * Time: 下午4:16
 */

namespace App\Support;

/**
 * @desc http://lbsyun.baidu.com/index.php?title=webapi/ip-api
 * Class BaiduIpLocation
 * @package App\Support
 */
class BaiduIpLocation
{
    /**
     * @param string $ip
     * @return string
     * @throws \Exception
     */
    public function getIpLocation($ip = '')
    {
        $url = 'https://api.map.baidu.com/location/ip';

        $ak = config('app.14k.bai_du_ip_ak');

        $params = [
            'ip' => $ip,
            'ak' => $ak,
            'coor' => 'bd09ll'
        ];

        $result = curl($url, ['query' => $params]);

        if ($result['status'] == 0) {
            return $result['address'] ?? $result['content']['address'];
        }

        if ($result['status'] == 1) {
            // 服务器内部错误,该服务响应超时或系统内部错误
            return 'Mars';
        }

        throw new \Exception($result['message'] ?? 'Unknown Error', 400);
    }
}
