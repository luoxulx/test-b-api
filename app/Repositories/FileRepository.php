<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/19
 * Time: 下午5:22
 */

namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Facades\DB;

class FileRepository extends BaseRepository
{

    protected $fileManager;

    public function __construct(File $file)
    {
        $this->model = $file;
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
     * 仅删除图片
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $data = $this->getById($id);
        try {
            $temp = DB::table('articles')->where(['thumbnail' => $data->url])->first(['id', 'title']);
            if ($temp !== null) {
                throw new \Exception('[id: '.$temp->id.', Title: '.$temp->title.'使用中], 不能删除! ');
            }
            $data->delete();
        }catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return true;
    }
}
