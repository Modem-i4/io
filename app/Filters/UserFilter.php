<?php


namespace App\Filters;


class UserFilter extends QueryFilter
{

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [
        'id',
        'name',
        'email',
        'role',
    ];

    protected $sortable = [
        'id',
        'name',
        'email',
        'role',
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
