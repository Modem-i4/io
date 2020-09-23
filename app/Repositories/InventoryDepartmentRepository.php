<?php

namespace App\Repositories;

use App\Models\InventoryDepartment as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryDepartmentRepository extends CoreRepository
{
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
     */
    protected function getModelClass()
    {
        return Model::class; //абстрагування моделі InventoryDepartment, для легшого створення іншого репозиторія
    }

    /**
    */
    public function getForShow($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->toBase()
            ->first();
    }

    /**
     * Отримати всі відділи
     *
     * @return
     */
    public function getAll()
    {
        /*$columns = implode(', ', [
            'id',
            'title',  //додаємо поле id_title  CONCAT (id, ". ", title) AS id_title'
        ]);*/
        $perPage = request('perPage');
        $columns = ['id', 'title', 'parent_id'];

        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentDepartment:id,title',]) //?
            ->filter()
            ->paginate($perPage);
        return $result;

    }

    public function getAll1()
    {
        /*$columns = implode(', ', [
            'id',
            'title',  //додаємо поле id_title  CONCAT (id, ". ", title) AS id_title'
        ]);*/
        $perPage = request('perPage');
        $columns = ['inventory_departments.id', 'inventory_departments.title', 'inventory_departments.parent_id', 'ide.title as parent_title'];

        /*$result = $this->startConditions()
            //->select($columns)
            ->with(['parentDepartment:id,title',]) //?
            ->filter()
            ->paginate($perPage);

        $result->sortByDesc(function($product) {
            return $product->parentDepartment->title;
        });*/
        //$order = 'asc';
        $result = $this->startConditions()
            ->select($columns)
            ->with(['parentDepartment:id,title',])
            ->join('inventory_departments as ide', 'inventory_departments.parent_id', '=', 'ide.id')
            //->orderBy('parent_title', $order)
            ->filter()
            ->paginate($perPage);
        /*//->select($columns)
            ->with('parentDepartment:id,title')
            ->get()
            ->sortBy(function($department) {
                return $department->parentDepartment->title;
            })
            ->filter()
            ->take(10)
            //->paginate($perPage)*/
            ;
        //return response()->json(['data' => [$result]]);
        return $result;

    }

    /**
     *  Пошук дочірніх елементів
     *  @param int $id
     *  @return Model
     */
    public function getChild($id)
    {
        return $this->startConditions()->where('parent_id',$id)->first();
    }

}
