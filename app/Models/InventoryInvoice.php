<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryInvoice extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'number',
        'date',
        'provider_id',
        'file_url',
        'total_sum'
    ];

    public function licenses()
    {
        return $this->hasMany(InventoryLicense::class, 'invoice_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'invoice_id', 'id');
    }
}
