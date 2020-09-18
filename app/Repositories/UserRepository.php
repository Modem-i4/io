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
    public function getAll()
    {
        $columns = ['id', 'name', 'email', 'role'];

        $result = $this->startConditions()
            ->select($columns)
            ->toBase()
            ->get();
        return $result;
    }
}
