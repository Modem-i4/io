<?php


namespace App\Filters;


class InventoryDepartmentFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        //'inventory_departments.id',
        'inventory_departments.title',
        'parent.title',
    ];

    protected $sortable = [
        'id',
        'title',
        'parent.title',
    ];
}
