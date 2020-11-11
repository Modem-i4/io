<?php

namespace App\Repositories;

use App\Models\InventoryType as Model;

/**
 * Class InventoryTypeRepository.
 */
class InventoryTypeRepository extends CoreRepository
{
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
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
            ->select($columns)
            ->get();

        return $result;

    }

    /**
     * Отримати всі типи
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
