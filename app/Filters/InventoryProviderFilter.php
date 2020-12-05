<?php


namespace App\Filters;


class InventoryProviderFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'title',
        'address',
        'phone',
    ];

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $sortable = [
        'id',
        'title',
        'address',
        'phone',
    ];
}