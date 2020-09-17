<?php


namespace App\Traits;


trait Filterable
{
    /**
     * @var \App\Filters\QueryFilter
     */
    protected $filter;

    public function __construct()
    {
        $this->filter = app($this->getFilterClass());
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFilter($query)
    {
        return $this->filter->apply($query);
    }

    /**
     * @return \App\Filters\QueryFilter
     */
    abstract protected function getFilterClass();
}
