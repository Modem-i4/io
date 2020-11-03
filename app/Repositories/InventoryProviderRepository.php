<?php

namespace App\Repositories;

use App\Models\InventoryProvider as Model;

/**
 * Class InventoryTypeRepository.
 */
class InventoryProviderRepository extends CoreRepository
{
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
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
            ->select($columns)
            ->get();

        return $result;

    }

    /**
     * Отримати всі відділи
     *
     * @return \Illuminate\Support\Collection
     */

    public function getAllWithPaginateAndFiltering()
    {

        $perPage = request('perPage');
        $columns = ['id', 'title', 'address', 'phone'];

        $result = $this->startConditions()
            ->select($columns)
            ->filter()
            ->paginate($perPage);

        return $result;

    }
}
