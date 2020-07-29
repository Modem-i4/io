<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository.
 * 
 * Репозиторій для роботи з сутністю. 
 * Може видавати набори даних.
 * Не може змінювати та створювати сутності.
 */
abstract class CoreRepository
{
    /** 
     * @var Model 
     */
    protected $model;

    /** CoreRepository constructor */
    public function __construct()
    {
        $this->model = app($this->getModelClass()); //створюємо новий об'єкт з порожнім станом
    }
    
    /**
     *  @return mixed 
     */
    abstract protected function getModelClass();

    /**
     *  @return Model|\Illuminate\Foundation\Application|mixed 
     */
    protected function startConditions()
    {
        return clone $this->model;  //клонуємо модель, яка прийде, для того щоб не зберігати стан в моделі
    }
}
