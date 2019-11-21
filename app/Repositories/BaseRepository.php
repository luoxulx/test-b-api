<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:55
 */
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function paginate()
    {
        $perPage = request()->get('per_page', 10);

        return $this->model->orderBy('updated_at', 'desc')->paginate($perPage);
    }

    public function all($columns = array('*'))
    {
        return $this->model->orderBy('updated_at', 'desc')->get($columns);
    }

    public function create($input)
    {
        $this->model->fill($input);

        $this->model->save();

        return $this->model;
    }

    public function updateColumn(int $id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    public function update(int $id, $input)
    {
        $this->model = $this->getById($id);

        $this->model->fill($input);

        return $this->model->save();
    }

    /**
     * @param integer $id
     * @return int
     */
    public function destroy(int $id)
    {
        return $this->getById($id)->delete();
    }

    public function batchDestroy(array $ids)
    {
        return $this->model->destroy($ids);
    }

    public function setDecrement(string $column, int $val = 1)
    {
        return $this->model->decrement($column, $val);
    }

    public function setIncrement(string $column, int $val = 1)
    {
        return $this->model->increment($column, $val);
    }

    /**
     * @param string $field  eg: facebook_id
     * @param int $value     eg: facebook_id value
     * @return mixed
     */
    public function getColumnByIdField(string $field, int $value)
    {
        return $this->model->where($field, $value)->first();
    }


    // transaction
    protected function beginTransaction()
    {
        DB::beginTransaction();
    }
    protected function commit()
    {
        DB::commit();
    }
    protected function rollback()
    {
        DB::rollBack();
    }

    protected function incrementNoUpdateAt(int $id, string $field)
    {
        // updated_at
    }

}
