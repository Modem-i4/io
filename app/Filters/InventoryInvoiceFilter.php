<?php


namespace App\Filters;


class InventoryInvoiceFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'base.id',
        'base.number',
        'base.date',
        'base.total_sum',

        'provider.title',
    ];

    /**
     * The attributes that can be sorted
     *
     * @var array
     */
    protected $sortable = [
        'id',
        'number',
        'date',
        'total_sum',

        'provider_title',
    ];
}
