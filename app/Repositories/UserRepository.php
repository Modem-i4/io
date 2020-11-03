<?php

namespace App\Repositories;

use App\Models\User as Model;

/**
 * Class UserRepository.
 */
class UserRepository extends CoreRepository
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
    public function getForShow($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->toBase()
            ->first();
    }

    /**
     * Отримати всіх користувачів
     *
     * @return
     */
    public function getForEdit($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    public function getAllForList()
    {
        $columns = ['id', 'name'];

        $result = $this->startConditions()
            ->select($columns)    //TODO: toBase?
            ->get();

        return $result;
    }

    /**
     * Отримати всіх користувачів
     *
     * @return id, title
     */

    public function getAllWithPaginateAndFiltering()
    {

        $perPage = request('perPage');
        $columns = ['id', 'name', 'email', 'role'];

        $result = $this->startConditions()
            ->select($columns)
            ->filter()
            ->paginate($perPage);

        return $result;

    }
}
