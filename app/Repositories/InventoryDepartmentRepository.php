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

        $perPage = request('perPage');
        $columns = ['inventory_departments.id as id', 'inventory_departments.title as title', 'inventory_departments.parent_id as parent_id', 'inv_dep.title as parent_title'];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentDepartment:id,title',])
            ->join('inventory_departments as inv_dep', 'inventory_departments.parent_id', '=', 'inv_dep.id')
            //->orderBy('parent_title', $order)
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
