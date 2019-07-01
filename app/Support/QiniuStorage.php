<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/7/1
 * Time: 下午3:34
 */

namespace App\Support;


use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class QiniuStorage
{
    public $bucket;
    public $expires;

    protected $accessKey;
    protected $secretKey;
    protected $auth;

    public function __construct()
    {
        $this->accessKey = config('app.14k.qn_access_key');
        $this->secretKey = config('app.14k.qn_secret_key');
        $this->bucket = 'net-us';
        $this->expires = 3600;

        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function uploadToken($key = null)
    {
        return $this->auth->uploadToken($this->bucket, $key, $this->expires);
    }

    public function delete($key = null)
    {
        $bucketManager = new BucketManager($this->auth);

        return $bucketManager->delete($this->bucket, $key);
    }
}
