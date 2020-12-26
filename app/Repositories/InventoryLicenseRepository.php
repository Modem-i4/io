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
            'base.id as id',
            'base.title as title',
            'base.price as price',

            'item.inventory_number as item_number',
            'invoice.number as invoice_number',
            'owner.name as owner_name',
        ];
        //$columns = '*';

        $result = $this->startConditions()
            ->from('inventory_licenses as base')
            ->select($columns)
            ->join('inventory_items as item', 'base.item_id', '=', 'item.id')
            ->join('inventory_invoices as invoice', 'base.invoice_id', '=', 'invoice.id')
            ->join('users as owner', 'base.owner_id', '=', 'owner.id')
            ->filter()
            ->paginate($perPage);

        return $result;
    }


    public function getAllWithRelationsByInvoiceId($invoiceId)
    {

        $columns = [
            'base.id as id',
            'base.title as title',
            'base.price as price',
            'base.invoice_id as invoice_id',

            'item.inventory_number as item_number',
            'owner.name as owner_name',
        ];

        $result = $this->startConditions()
            ->from('inventory_licenses as base')
            ->select($columns)
            ->where('base.invoice_id', $invoiceId)
            ->join('inventory_items as item', 'base.item_id', '=', 'item.id')
            ->join('users as owner', 'base.owner_id', '=', 'owner.id')
            ->get();

        return $result;
    }
}
