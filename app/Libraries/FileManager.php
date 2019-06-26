<?php /** @noinspection PhpParamsInspection */

/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午4:46
 */

namespace App\Libraries;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
     * 普通上传，<4M
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


    /**
     * @param string $dir
     * @param bool $resize
     * @return array
     */
    public function storeByIntervention($dir = 'temp', $resize = false)
    {
        $file = request()->file('file');
        $picName = $file->getClientOriginalName();
        $dirData = '/' . date('Y') . '/' . date('m') . '/';
        $path = $dir . $dirData . md5(time().$picName).'.png';

        $img = Image::make($file);

        $img->insert(public_path('watermark/14k-water.png'), 'bottom-right', 5, 5); //Victor Frankenstein
        if ($resize === true) {
            $img->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $img->encode('png', 85);

        $this->disk->put($path, $img);

        return [
            'filename' => md5(time().$picName).'.png',
            'original_name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
            'size' => $this->formatSize($file->getSize()),
            'real_path' => $dir . $dirData,
            'relative_url' => 'storage/' . $dir . $dirData,
            'url' => asset('storage/'.$path),
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
