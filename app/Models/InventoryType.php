<?php

namespace App\Models;

use App\Filters\TypeFilter;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    use Filterable;

    public $timestamps = false;
    protected $fillable = [
        'title',
    ];

    protected function getFilterClass()
    {
        return TypeFilter::class;
    }
}
