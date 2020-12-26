<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLicense extends Model
{
    use HasFactory, Filterable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'price',
        'item_id',
        'invoice_id',
        'owner_id',
        'end_date'
    ];



    public function type()
    {
        return $this->belongsTo(InventoryType::class, 'type_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'item_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(InventoryInvoice::class, 'invoice_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
