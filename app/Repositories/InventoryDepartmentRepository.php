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

    public function getForEdit($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    /**
     * Отримати всі відділи
     *
     * @return id, title
     */

    public function getAll()
    {

        $perPage = request('perPage');
        $columns = ['id', 'title'];

        $result = $this->startConditions()
            ->select($columns)
            ->filter()
            ->paginate($perPage);

        return $result;

    }

    public function getAllForList()
    {
        $columns = ['id', 'title'];

        $result = $this->startConditions()
            ->select($columns)
            ->get();

        return $result;

    }

    /**
     * Отримати всі відділи з батьківськими категоріями
     *
     * @return id, title, parent_id, parent_title, parent_department {id, title}
     */

    public function getAllWithParents()
    {

        $perPage = request('perPage');
        $columns = ['inventory_departments.*', 'inv_dep.title as parent_title'];

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
     *  Пошук наявності дочірніх елементів для перевірки при видаленні
     *  @param int $id
     *  @return Model
     */
    public function getChild($id)
    {
        return $this->startConditions()->where('parent_id', $id)->first();
    }

}
