<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class InventoryStatus extends Model
{
    use Filterable;

    public $timestamps = false;
    protected $fillable = [
        'title',
    ];
}
