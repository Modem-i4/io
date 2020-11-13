<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'type_id',
        'model_id',
        'department_id',
        'owner_id',
        'price',
        'invoice_id',
        'status_id',
        'inventory_number'
    ];
}
