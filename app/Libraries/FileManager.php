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

    public function chunkStore(UploadedFile $file, $dir = 'temp')
    {
        $chunk = intval(request()->post('chunk', 0));
        $count = intval(request()->post('chunks', 0));
        $originalName = $file->getClientOriginalName();
        $realPath = '';
        $tempRealPath = $file->getRealPath();

        if ($count === $chunk) {
            // 直接保存
            $realPath = $this->disk->putFile($dir, $file);
        }else {
            // chunk save
            $tempFilename = md5($originalName).'-'.($chunk+1).'.tmp';
            $this->disk->put($tempFilename, file_get_contents($tempRealPath));

            // 合并
            if ($chunk + 1 === $count) {
                $realPath = md5(time().Str::random()).'.'.$file->getClientOriginalExtension();

                $fp = fopen($realPath,'ab');

                for($i=0; $i<$count; $i++) {
                    $tmp_files = $this->cleanFolder('temp_chunk').md5($originalName).'-'.($i+1).'.tmp';
                    $handle = fopen($tmp_files,'rb');
                    fwrite($fp, fread($handle,filesize($tmp_files)));
                    fclose($handle);
                    unlink($tmp_files);
                }
                fclose($fp);
            }
        }

        return [
            'filename' => str_replace($dir.'/', '', $realPath),
            'original_name' => $originalName,
            'mime' => $file->getMimeType(),
            'size' => $this->formatSize($file->getSize()),
            'real_path' => $realPath,
            'relative_url' => 'storage/' . $realPath,
            'url' => asset('storage/' . $realPath),
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
