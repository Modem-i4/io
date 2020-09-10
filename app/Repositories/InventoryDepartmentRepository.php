<?php

namespace App\Repositories;

use App\Models\InventoryDepartment as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class InventoryDepartmentRepository.
 */
class InventoryDepartmentRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class; //абстрагування моделі InventoryDepartment, для легшого створення іншого репозиторія
    }
    /**
     *  Отримати модель для редагування в адмінці
     *  @param int $id
     *  @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
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
    /**
     *  Отримати список для виводу
     *  @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'title',  //додаємо поле id_title  CONCAT (id, ". ", title) AS id_title'
        ]);

        $result = $this                           //2 варіант
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        //dd($result);

        return $result;

    }
    /**
     *  Отримати список для виводу
     *  @return Collection
     */
    public function getForJson($term)
    {
        $columns = implode(', ', [
            'id',
            'title AS text', 
        ]);

        $result = $this                         
            ->startConditions()
            ->selectRaw($columns)
            ->where('title', 'LIKE', '%'.$term.'%')
            ->toBase()
            ->get();

        return $result;

    }

    /**
     * Отримати категорію для виводу пагінатором
     * 
     * @param int|null $perPage
     * 
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(['parentDepartment:id,title',])
            //->paginate($perPage)
            //->toBase()
            ->get();
            //dd($result);
        return $result;
    }
}
