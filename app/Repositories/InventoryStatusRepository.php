<?php

namespace App\Repositories;

use App\Models\InventoryStatus as Model;
use Illuminate\Support\Collection;

/**
 * Class InventoryTypeRepository.
 */
class InventoryStatusRepository extends CoreRepository
{
    /**
     * Отримати модель для редагування в адмінці
     * @return string
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

    /**
     * Отримати всі відділи
     *
     * @return Collection
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
