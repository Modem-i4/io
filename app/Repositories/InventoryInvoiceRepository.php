<?php

namespace App\Repositories;

use App\Models\InventoryInvoice as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryInvoiceRepository extends CoreRepository
{
    /**
     * Отримати модель для редагування в адмінці
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Отримати всі відділи з батьківськими категоріями
     *
     * @return Collection
     */
    public function getAllWithRelationsAndPaginate()
    {

        $perPage = request('perPage');
        $columns = [
            'base.id as id',
            'base.number as number',
            'base.date as date',
            'base.file_url',    //Full story
            'base.total_sum',

//            'base.provider_id',

            'provider.title as provider_title',
        ];

        $result = $this->startConditions()
            ->from('inventory_invoices as base')
            ->select($columns)
            ->leftJoin('inventory_providers as provider', 'base.provider_id', '=', 'provider.id')
            ->filter()
            ->toBase()
            ->paginate($perPage);

        return $result;
    }
}
