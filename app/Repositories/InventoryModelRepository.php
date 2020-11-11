<?php

namespace App\Repositories;

use App\Models\InventoryModel as Model;

/**
 * Class InventoryTypeRepository.
 */
class InventoryModelRepository extends CoreRepository
{
    /**
     *  Отримати модель для редагування в адмінці
     *  @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getForEdit($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    public function getAllForList()
    {
        $columns = ['id', 'title'];

        $result = $this->startConditions()
            ->select($columns)    //TODO: toBase?
            ->get();

        return $result;
    }

    /**
     * Отримати всі моделі
     *
     * @return id, title
     */

    public function getAllWithPaginateAndFiltering()
    {

        $perPage = request('perPage');
        $columns = ['id', 'title'];

        $result = $this->startConditions()
            ->select($columns)
            ->filter()
            ->paginate($perPage);

        return $result;
    }
}
