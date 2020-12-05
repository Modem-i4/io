<?php


namespace App\Filters;


class InventoryLicenseFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'base.id',
        'base.title',
        //TODO: 'type.title',
        'base.price',
        'item.inventory_number',
        'invoice.number',
        'owner.name',
    ];

    /**
     * The attributes that can be sorted
     *
     * @var array
     */
    protected $sortable = [
        'base.id',
        'base.title',
        //TODO: 'type.title',
        'base.price',
        'item_number',
        'invoice_number',
        'owner_name',
    ];
}
