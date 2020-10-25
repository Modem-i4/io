<?php


namespace App\Filters;


class TypeFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'title',
    ];

    protected $sortable = [
        'id',
        'title',
    ];
}