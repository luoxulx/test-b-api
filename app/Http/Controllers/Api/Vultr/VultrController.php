<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/11
 * Time: 下午3:35
 */

namespace App\Http\Controllers\Api\Vultr;


class VultrController extends BaseController
{
    /**
     * Retrieve information about the current account.
     * @return mixed
     */
    public function accountInfo()
    {
        $uri = '/v1/account/info';

        return $this->curlVultr($uri);
    }

    /**
     * Retrieve a list of available applications. These refer to applications that can be launched when creating a Vultr VPS.
     * The "surcharge" field is deprecated and will always be set to zero.
     * @return mixed
     */
    public function applications()
    {
        $uri = '/v1/app/list';

        return $this->curlVultr($uri);
    }

    /**
     * Retrieve information about the current API key.
     * @return mixed
     */
    public function authInfo()
    {
        $uri = '/v1/auth/info';

        return $this->curlVultr($uri);
    }

    /**
     * List all backups on the current account.
     * @return mixed
     */
    public function backupList()
    {
        $uri = '/v1/backup/list';

        $param['SUBID'] = 1;
        $param['BACKUPID'] = '';

        return $this->curlVultr($uri);
    }

    /**
     * Get the bandwidth used by a bare metal server.
     * @return mixed
     */
    public function bandwidth()
    {
        $uri = '/v1/baremetal/bandwidth';

        $param['SUBID'] = 900000;

        return $this->curlVultr($uri, ['query' => $param]);
    }

    /**
     * @return mixed
     */
    public function getAppInfo()
    {
        $a = config('app.14k.other_web');

        $this->response->json(['data'=>$a]);
        die;
        $uri = '/v1/baremetal/get_app_info';

        return $this->curlVultr($uri);
    }

    /**
     * List all bare metal servers on the current account. This includes both pending and active servers.
     * @return mixed
     */
    public function serverList()
    {
        $uri = '/v1/baremetal/list';

        return $this->curlVultr($uri);
    }

}
