<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryInvoice extends Model
{
    protected $fillable = [
        'number',
        'date',
        'provider_id',
        'file_url',
        'total_sum'
    ];
}
