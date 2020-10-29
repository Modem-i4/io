<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    use Filterable;

    public $timestamps = false;
    protected $fillable = [
        'title',
    ];
}
