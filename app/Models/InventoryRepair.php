<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRepair extends Model
{
    use HasFactory, Filterable;
    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'start_date',
        'end_date',
        'user_id',
        'provider_id',
    ];
}
