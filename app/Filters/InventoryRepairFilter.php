<?php


namespace App\Filters;


class InventoryRepairFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'item.inventory_number',
        'provider.title',
        'user.name',
        'start_date',
        'end_date',
    ];

    protected $sortable = [
        'id',
        'item.inventory_number',
        'provider.title',
        'user.name',
        'start_date',
        'end_date',
    ];
}
