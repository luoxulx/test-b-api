<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/6/4
 * Time: 上午9:41
 */

namespace App\Http\Controllers\Api\V1;

use App\Support\SystemLogViewer;
use Illuminate\Http\Request;

class SystemLogController extends BaseController
{

    public function index($file = null, Request $request)
    {
        $offset = $request->get('offset');

        if ($file === null) {
            $file = (new SystemLogViewer())->getLastModifiedLog();
        }

        $viewer = new SystemLogViewer($file);

        $data = [
            'logs' => $viewer->fetch($offset),
            'logFiles'  => $viewer->getLogFiles(),
            'fileName'  => $viewer->file,
            'end'       => $viewer->getFilesize(),
            'tailPath'  => route('api.system.log.file.tail', ['file' => $viewer->file]),
            'prevUrl'   => $viewer->getPrevPageUrl(),
            'nextUrl'   => $viewer->getNextPageUrl(),
            'filePath'  => $viewer->getFilePath(),
            'size'      => static::bytesToHuman($viewer->getFilesize()),
            'levelColors' => $viewer->levelColors
        ];

        return $this->response->json(['data'=>$data]);
    }


    public function tail($file, Request $request)
    {
        $offset = $request->get('offset');

        $viewer = new SystemLogViewer($file);

        list($pos, $logs) = $viewer->tail($offset);

        return compact('pos', 'logs');
    }

    protected static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
