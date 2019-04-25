<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午4:46
 */

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{

    /**
     * @var $disk
     */
    protected $disk;

    public function __construct()
    {
        $this->disk = Storage::disk('public');
    }

    /**
     * Handle the file upload.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param string                                              $dir
     * @param string                                              $name
     *
     * @return array|bool
     */

    public function store(UploadedFile $file, $dir = 'temp', $name = '')
    {
        $mime = $file->getMimeType();
        $dirDate = '/' . date('Y') . '/' . date('m');
        $dir .= $dirDate;

        if ($name) {
            $realPath = $this->disk->putFileAs($dir, $file, $name);
            $filename = $name;
        }else {
            $realPath = $this->disk->putFile($dir, $file);
            $filename = str_replace($dir.'/', '', $realPath);
        }

        return [
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $mime,
            'size' => $this->formatSize($file->getSize()),
            'real_path' => $realPath,
            'relative_url' => 'storage/' . $realPath,
            'url' => asset('storage/' . $realPath),
        ];
    }

    public function patchStore(UploadedFile $file, $dir = 'temp')
    {
        $dirDate = '/' . date('Y') . '/' . date('m');
        $dir .= $dirDate;

        $chunk = intval(request()->post('chunk', 0));
        $chunks = intval(request()->post('chunks', 0));

        $originalName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $realPath = $file->getRealPath(); //临时目录
        $saved_name = '';

        if ($chunk === $chunks) {
            $saved_name = md5('saved_' . date('Ymd-His')) . ".$ext";

            $this->disk->put($dir . $saved_name, file_get_contents($realPath)); // 直接保存

        } else {
            $filename = md5($originalName).'-'.($chunk+1).'.tmp';
            $this->disk->put('patchPath'.$filename, file_get_contents($realPath));

            if (($chunk + 1) === $chunks) {
                $saved_name = md5('saved_'. date('Ymd-His')) . ".$ext";
                $file_names = storage_path('app/patchPath') . $saved_name;

                $fp = fopen($file_names,'ab');

                for($i=0; $i<$chunks; $i++){
                    $tmp_files = storage_path('app/patchPath/') . md5($originalName).'-'.($i+1).'.tmp';
                    $handle = fopen($tmp_files,'rb');
                    fwrite($fp, fread($handle, filesize($tmp_files)));
                    fclose($handle);
                    unlink($tmp_files);
                }
                //关闭句柄
                fclose($fp);
            }
        }

        return [
            'filename' => $saved_name,
            'original_name' => $originalName,
            'mime' => $file->getMimeType(),
            'size' => $this->formatSize($file->getSize()),
            'real_path' => $saved_name,
            'relative_url' => 'storage/' . $saved_name,
            'url' => asset('storage/' . $saved_name),
        ];
    }

    /**
     * Determine whether the file exists
     *
     * @param  string $path
     * @return boolean
     */
    public function checkFileExists($path): bool
    {
        return $this->disk->exists($path);
    }

    /**
     * Delete the file.
     *
     * @param $path&$name
     * @return mixed
     */
    public function deleteFile($path)
    {
        return $this->disk->delete($path);
    }

    /**
     * Clean the folder.
     *
     * @param $folder
     * @return string
     */
    private function cleanFolder($folder): string
    {
        return '/' . trim(str_replace('..', '', $folder), '/'); //eq: ../../uploads
    }

    /**
     * Get a readable file size.
     *
     * @param $bytes
     * @param $decimals
     * @return string
     */
    private function formatSize($bytes, $decimals = 2): string
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];

        $floor = floor((\strlen($bytes)-1)/3);

        return sprintf("%.{$decimals}f", $bytes/pow(1024, $floor)).@$size[$floor];
    }
}
