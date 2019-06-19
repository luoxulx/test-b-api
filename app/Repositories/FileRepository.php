<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:22
 */

namespace App\Repositories;


use App\Libraries\FileManager;
use App\Models\File;

class FileRepository extends BaseRepository
{

    protected $fileManager;

    public function __construct(File $file, FileManager $fileManager)
    {
        $this->model = $file;
        $this->fileManager = $fileManager;
    }

    /**
     * @param $input
     * @return File
     * @throws \Exception
     */
    public function create($input)
    {
        $this->model->fill($input);
        try {
            $this->model->save();
        }catch (\Exception $exception) {
            $this->fileManager->deleteFile($input['real_path']);

            throw new \Exception($exception->getMessage());
        }

        return $this->model;
    }

    public function paginate()
    {
        $perPage = request()->get('per_page', 10);

        return $this->model->orderBy('updated_at', 'desc')->paginate($perPage);
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $data = $this->getById($id);
        try {
            $this->fileManager->deleteFile($data->real_path);
            $data->delete();
        }catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return true;
    }
}
