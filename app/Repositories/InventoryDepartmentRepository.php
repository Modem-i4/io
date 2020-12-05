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
     * Отримати модель для редагування в адмінці
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class; //абстрагування моделі InventoryDepartment, для легшого створення іншого репозиторія
    }

    /**
     * @param $id
     * @return object
     */
    public function getForShow($id): object
    {
        return $this->startConditions()
            ->where('id', $id)
            ->toBase()
            ->first();
    }

    /**
     * @param $id
     * @return object
     */
    public function getForEdit($id): object
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    /**
     * Отримати всі відділи
     *
     * @return Collection
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

    /**
     * @return \Illuminate\Support\Collection
     */
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
     * @return Collection
     */

    public function getAllWithParents()
    {

        $perPage = request('perPage');
        $columns = ['inventory_departments.*'];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['parent:id,title',])
            ->withCount('children')
            ->join('inventory_departments as parent', 'inventory_departments.parent_id', '=', 'parent.id')
            ->filter()
            ->paginate($perPage);

        return $result;

    }

    /**
     * @param array $idList
     * @return Collection
     */
    public function getByIdListWithChildCount($idList)
    {
        $columns = ['id', 'title'];

        $result = $this->startConditions()
            ->select($columns)
            ->withCount('children')
            ->whereIn('id', $idList)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Пошук наявності дочірніх елементів для перевірки при видаленні
     * @param int $id
     * @return Model
     */
    public function getChild(int $id)
    {
        return $this->startConditions()->where('parent_id', $id)->first();
    }

}
