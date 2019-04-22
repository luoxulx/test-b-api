<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2019/4/17
 * Time: 下午8:54
 */
namespace App\Repositories;
interface BaseRepositoryInterface
{
    public function getById(int $id);

    public function paginate();

    public function all($columns = array('*'));

    public function create($input);

    public function updateColumn(int $id, $input);

    public function update(int $id, $input);

    /**
     * @param integer|array $ids
     * @return mixed
     */
    public function destroy($ids);
}
