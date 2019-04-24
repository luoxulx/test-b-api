<?php

if (!function_exists('curl')) {
    /**
     * @param $url
     * @param array $params
     * @param string $method
     * @param array $header
     * @return mixed
     * @throws Exception
     */
    function curl($url, $params = [], $method = 'GET', $header = ['Content-Type: application/json; charset=utf-8'])
    {
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $header
        );
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                if ($params){
                    $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                }else {
                    $opts[CURLOPT_URL] = $url;
                }
                break;
            case 'POST':
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = http_build_query($params);
                break;
            case 'PUT' :
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
                $opts[CURLOPT_POSTFIELDS]      = http_build_query($params);
                break;
            case 'DELETE' :
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                $opts[CURLOPT_POSTFIELDS] = http_build_query($params);
                break;
            default:
                throw new \Exception('Unsupported mode of request!', 400);
        }

        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new \Exception($error, 400);
        }

        return $data;
    }
}
