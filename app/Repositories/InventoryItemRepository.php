<?php

namespace App\Repositories;

use App\Models\InventoryItem as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryItemRepository extends CoreRepository
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
            'base.id',
            'base.inventory_number',
            'base.comment',
            'base.has_parts',

//            'base.part_of',
//            'base.type_id',
//            'base.model_id',
//            'base.department_id',
//            'base.owner_id',
//            'base.status_id',
//            'base.invoice_id',
//            'base.writeoff_id',
//            'base.utilization_id',

            'parent.inventory_number as parent_number',
            'type.title as type_title',
            'model.title as model_title',
            'department.title as department_title',
            'owner.name as owner_name',
            'status.title as status_title',
            'invoice.number as invoice_number',
        ];

        $result = $this->startConditions()
            ->from('inventory_items as base')
            ->select($columns)
            ->leftJoin('inventory_items as parent', 'base.part_of', '=', 'parent.id')
            ->leftJoin('inventory_types as type', 'base.type_id', '=', 'type.id')
            ->leftJoin('inventory_models as model', 'base.model_id', '=', 'model.id')
            ->leftJoin('inventory_departments as department', 'base.department_id', '=', 'department.id')
            ->leftJoin('users as owner', 'base.owner_id', '=', 'owner.id')
            ->leftJoin('inventory_statuses as status', 'base.status_id', '=', 'status.id')
            ->leftJoin('inventory_invoices as invoice', 'base.invoice_id', '=', 'invoice.id')
            ->leftJoin('inventory_writeoffs as writeoff', 'base.writeoff_id', '=', 'writeoff.id')
            ->leftJoin('inventory_utilizations as utilization', 'base.utilization_id', '=', 'utilization.id')
            ->filter()
            ->toBase()
            ->paginate($perPage);

        return $result;
    }
}
