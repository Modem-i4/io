<?php


namespace App\Filters;


class DepartmentsFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'id',
        'title',
        'parent_id',
    ];

    protected $sortable = [
        'id',
        'title',
        'parent_id',
        'parent_title',
    ];

    /*
    public function nameFilter($value)
    {
        return $this->builder->where('name', 'like', "%$value%");
    }

    public function emailFilter($value)
    {
        return $this->builder->where('email', 'like', "%$value%");
    }

    public function roleFilter($value)
    {
        return $this->builder->where('role', $value);
    }*/
}
