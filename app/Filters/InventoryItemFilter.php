<?php


namespace App\Filters;


class InventoryItemFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'base.id',
        'base.inventory_number',

        'parent.inventory_number',
        'type.title',
        'model.title',
        'department.title',
        'owner.name',
        'status.title',
        'invoice.number',
    ];

    /**
     * The attributes that can be sorted
     *
     * @var array
     */
    protected $sortable = [
        'id',
        'inventory_number',

        'parent_number',
        'type_title',
        'model_title',
        'department_title',
        'owner_name',
        'status_title',
        'invoice_number',
    ];
}
