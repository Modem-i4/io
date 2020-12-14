<?php

namespace App\Repositories;

use App\Models\InventoryRepair as Model;

/**
 * Class RepairsRepository.
 */
class InventoryRepairRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class; //абстрагування моделі InventoryRepairRepository, для легшого створення іншого репозиторія
    }
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
     */
    public function getForShow($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->toBase()
            ->first();
    }

    /**
     * Отримати всі записи про ремонт
     *
     * @return
     */
    public function getForEdit($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    public function getAllForList()
    {
        $columns = ['id', 'item_id', 'start_date', 'end_date', 'user_id', 'provider_id'];
        $result = $this->startConditions()
            ->select($columns)    //TODO: toBase?
            ->get();

        return $result;
    }

    /**
     * Отримати всі записи
     *
     * @return id, item_id, start_date, end_date, user_id, provider_id
     */

    public function getAllWithRelationsAndPaginate()
    {
        $perPage = request('perPage');
        $columns = [
            'base.id',
            'base.start_date',
            'base.end_date',

            'item.inventory_number as inventory_number',
            'user.name as user',
            'provider.title as provider',
        ];

        $result = $this->startConditions()
            ->from('inventory_repairs as base')
            ->select($columns)
            ->join('inventory_items as item', 'base.item_id', '=', 'item.id')
            ->join('users as user', 'base.user_id', '=', 'user.id')
            ->join('inventory_providers as provider', 'base.provider_id', '=', 'provider.id')
            ->filter()
            ->paginate($perPage);

        return $result;
    }
}
