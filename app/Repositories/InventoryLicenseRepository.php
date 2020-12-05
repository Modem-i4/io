<?php

namespace App\Repositories;

use App\Models\InventoryLicense as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryLicenseRepository extends CoreRepository
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
    public function getAllWithRelationsAndPaginate()    //TODO: Review necessary fields
    {

        $perPage = request('perPage');
        $columns = [
            'base.id',
            'base.title',
            'base.price',

            //'base.type_id',
            //'base.item_id',
            //'base.invoice_id',
            //'base.owner_id',

            'type.title as type_title',
            'item.inventory_number as item_number',
            'invoice.number as invoice_number',
            'owner.name as owner_name',
        ];
        //$columns = '*';

        $result = $this->startConditions()
            ->from('inventory_licenses as base')
            ->select($columns)
            //->with(['type:id,title', 'item:id,inventory_number', 'invoice:id,number', 'owner:id,name'])
            ->join('inventory_types as type', 'base.type_id', '=', 'type.id')
            ->join('inventory_items as item', 'base.item_id', '=', 'item.id')
            ->join('inventory_invoices as invoice', 'base.invoice_id', '=', 'invoice.id')
            ->join('users as owner', 'base.owner_id', '=', 'owner.id')
            ->filter()
            ->paginate($perPage);

        return $result;
    }
}
