<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'part_of',
        'type_id',
        'model_id',
        'department_id',
        'owner_id',
        'status_id',
        'inventory_number',
        'price',
        'invoice_id',
        'has_parts',
        'writeoff_id',
        'utilization_id',
        'comment',
    ];
}
