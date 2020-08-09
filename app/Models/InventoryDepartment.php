<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryDepartment extends Model
{
    /**
     * Class Inventory Department
     * 
     * @package App\Models
     * 
     * @property-read InventoryDepartment  $parentDepartment
     * @property-read string        $parentTitle
     */
    public $timestamps = false;
    const ROOT = 1;
    protected $fillable
        = [
            'title',
            'parent_id',
        ];
    /**
     * Корпус
     * 
     * @return InventoryDepartment
     */
    public function parentDepartment()
    {
        //належить корпусу
        return $this->belongsTo(InventoryDepartment::class, 'parent_id', 'id');
    }

    /**
     * Аксесуар (Accessor)
     * 
     * @url https://laravel.com/docs/7.x/eloquent-mutator
     * 
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentDepartment->title
            ?? ($this->isRoot()
                ? 'Корінь'
                : '???');
        
        return $title;
    }

    /**
     * Перевірка чи об'єкт є кореневим
     * 
     * @return bool
     */
    public function isRoot()
    {
        return $this->id === InventoryDepartment::ROOT;
    }
}
