<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/8
 * Time: 下午7:46
 */

namespace App\Support;


class YoudaoTranslate
{

    protected $uri;
    protected $appKey;
    protected $secretKey;
    protected $errorCode;

    public function __construct()
    {
        $this->uri = 'https://openapi.youdao.com/api';
        $this->appKey = 'xxx';
        $this->secretKey = 'xxx';

        $this->errorCode = [
            '101' => '缺少必填的参数，出现这个情况还可能是et的值和实际加密方式不对应',
            '102' => '不支持的语言类型',
            '103' => '翻译文本过长',
            '104' => '不支持的API类型',
            '105' => '不支持的签名类型',
            '106' => '不支持的响应类型',
            '107' => '不支持的传输加密类型',
            '108' => 'appKey无效，注册账号， 登录后台创建应用和实例并完成绑定， 可获得应用ID和密钥等信息，其中应用ID就是appKey（ 注意不是应用密钥）',
            '109' => 'batchLog格式不正确',
            '110' => '无相关服务的有效实例',
            '111' => '开发者账号无效',
            '113' => 'q不能为空',
            '201' => '解密失败，可能为DES,BASE64,URLDecode的错误',
            '202' => '签名检验失败',
            '203' => '访问IP地址不在可访问IP列表',
            '205' => '请求的接口与应用的平台类型不一致，如有疑问请参考[入门指南]()',
            '206' => '因为时间戳无效导致签名校验失败',
            '207' => '重放请求',
            '301' => '辞典查询失败',
            '302' => '翻译查询失败',
            '303' => '服务端的其它异常',
            '401' => '账户已经欠费停',
            '411' => '访问频率受限,请稍后访问',
            '412' => '长请求过于频繁，请稍后访问'
        ];
    }

    /**
     * @deprecated 仅支持 utf-8，长文本也不支持，暂时弃用
     * @param string $word
     * @param string $from
     * @param string $to
     * @return mixed
     * @throws \Exception
     */
    public function translate(string $word, $from='auto', $to='en')
    {
        $salt = $this->createUuid();
        $curtime = time();
        $sign = hash('sha256', $this->appKey . $this->truncate($word) . $salt . $curtime . $this->secretKey);

        $params = array(
            'q' => $word,
            'appKey' => $this->appKey,
            'salt' => $salt,
            'from' => $from,
            'to' => $to,
            'signType' => 'v3',
            'curtime' => $curtime,
            'sign' => $sign
        );

        $result = json_decode($this->call($this->uri, $params), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception(json_last_error_msg() ?? 'Unknown json decode error', 400);
        }

        if (isset($result['errorCode']) && $result['errorCode'] != 0) {
            $message = $this->errorCode[$result['errorCode']] ?? '';
            throw new \Exception($message . '  errorCode:'.$result['errorCode'], 400);
        }

        if (isset($result['translation']) && current($result['translation'])) {
            return $result[0];
        }

        throw new \Exception('translate unknown error', 400);
    }


    protected function call($url, $args=null, $method='post', $testflag = 0, $timeout = 20, $headers=array())
    {
        $ret = false;
        $i = 0;
        while($ret === false)
        {
            if($i > 1)
                break;
            if($i > 0) {
                sleep(1);
            }
            $ret = $this->callOnce($url, $args, $method, false, $timeout, $headers);
            $i++;
        }
        return $ret;
    }

    protected function createUuid(): string
    {
        $microTime = microtime();
        list($a_dec, $a_sec) = explode(' ', $microTime);
        $dec_hex = dechex($a_dec * 1000000);
        $sec_hex = dechex($a_sec);

        $this->ensureLength($dec_hex, 5);
        $this->ensureLength($sec_hex, 6);
        $guid = '';
        $guid .= $dec_hex;
        $guid .= $this->createGuidSection(3);
        $guid .= '-';
        $guid .= $this->createGuidSection(4);
        $guid .= '-';
        $guid .= $this->createGuidSection(4);
        $guid .= '-';
        $guid .= $this->createGuidSection(4);
        $guid .= '-';
        $guid .= $sec_hex;
        $guid .= $this->createGuidSection(6);

        return $guid;
    }

    protected function truncate(string $word): string
    {
        $len = \strlen($word);
        return $len <= 20 ? $word : (substr($word, 0, 10) . $len . substr($word, $len - 10, $len));
    }

    private function ensureLength(&$string, $length): void
    {
        $strlenVal = \strlen($string);
        if($strlenVal < $length) {
            $string = str_pad($string, $length, '0');
        }
        else if($strlenVal > $length) {
            $string = substr($string, 0, $length);
        }
    }

    private function createGuidSection(int $characters): string
    {
        $return = '';
        for($i = 0; $i < $characters; $i++) {
            $return .= dechex(random_int(0, 15));
        }
        return $return;
    }

    private function callOnce($url, $args=null, $method='post', $withCookie = false, $timeout = 20, $headers=array())
    {
        $ch = curl_init();
        if($method == 'post')
        {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        else
        {
            $data = $this->convert($args);
            if($data)
            {
                if(stripos($url, '?') > 0)
                {
                    $url .= "&$data";
                }
                else
                {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($headers))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if($withCookie)
        {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    private function convert(&$args)
    {
        $data = '';
        if (is_array($args))
        {
            foreach ($args as $key=>$val)
            {
                if (is_array($val))
                {
                    foreach ($val as $k=>$v)
                    {
                        $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                    }
                }
                else
                {
                    $data .="$key=".rawurlencode($val).'&';
                }
            }
            return trim($data, '&');
        }
        return $args;
    }

}
