<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryProvider extends Model
{
    use HasFactory, Filterable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'address',
        'phone',
    ];
}
