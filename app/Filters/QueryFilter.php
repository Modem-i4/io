<?php


namespace App\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Str;

abstract class QueryFilter
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var Request
     */
    protected $request;

    /**
     * The default namespace where filters reside.
     *
     * @var string
     */
    protected static $namespace = 'App\\Filters\\';

    /**
     * The attributes that can be searched
     *
     * @var array
     */
    protected $searchable = [];

    /**
     * The attributes that can be sorted
     *
     * @var array
     */
    protected $sortable = [];

    /**
     * The name of the "sortBy" parameter.
     *
     * @var string
     */
    protected $sortBy = 'sortBy';

    /**
     * The name of the "sortDirection" parameter.
     *
     * @var string
     */
    protected $sortDirection = 'sortDirection';

    /**
     * The name of the "search" parameter.
     *
     * @var string
     */
    protected $search = 'search';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function filters()
    {
        return request()->all();
    }

    public static function filterForModel($modelName)
    {
        $modelName = Str::after($modelName, 'App\\Models\\');
        $className = static::$namespace.$modelName.'Filter';

        return $className;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $filter => $value) {
            $filter = $filter.'Filter';
            if(method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        $this->search();
        $this->sort();

        return $this->builder;
    }


    public function sort()    //TODO: Add protected 'sortable' list, multiple sorting
    {
        if(in_array(request($this->sortBy), $this->sortable)) {
            $field = request($this->sortBy);

            $receivedDirection = Str::lower(request($this->sortDirection));
            $direction = ($receivedDirection == 'desc') ? 'desc' : 'asc';

            $this->builder
                ->orderBy($field, $direction);
        }
    }

    public function search()
    {
        if(request()->has($this->search))    // Якщо запит хоче виконати пошук
        {
            $searchString = request($this->search);

            foreach ($this->searchable as $field) {    // Перебираємо усі поля по яких доступний пошук
                $this->builder->orWhere($field, 'like', "%$searchString%");
            }
        }
    }

}
