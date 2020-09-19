<?php

namespace App\Repositories;

use App\Models\InventoryDepartment as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryDepartmentRepository extends CoreRepository
{
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
     */
    protected function getModelClass()
    {
        return Model::class; //абстрагування моделі InventoryDepartment, для легшого створення іншого репозиторія
    }

    /**
    */
    public function getForShow($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->toBase()
            ->first();
    }

    /**
     * Отримати всі відділи
     *
     * @return
     */
    public function getAll()
    {
        /*$columns = implode(', ', [
            'id',
            'title',  //додаємо поле id_title  CONCAT (id, ". ", title) AS id_title'
        ]);*/
        $perPage = request('perPage');
        $columns = ['id', 'title', 'parent_id'];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentDepartment:id,title',]) //?
            ->filter()
            ->paginate($perPage);
        return $result;

    }

    /**
     *  Пошук дочірніх елементів
     *  @param int $id
     *  @return Model
     */
    public function getChild($id)
    {
        return $this->startConditions()->where('parent_id',$id)->first();
    }

}
