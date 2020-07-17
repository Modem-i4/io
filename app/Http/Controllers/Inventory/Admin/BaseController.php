<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Inventory\BaseController as GuestBaseController;

/**
 * Базовий контроллер для всіх контроллерів керування в адмінці.
 * Має бути батьком для всіх контроллерів керування.
 * 
 * @package App\Http\Controllers\Inventory\Admin
 */
abstract class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor
     */
    public function __construct()
    {
        //Ініціалізація загальних елементів адмінки
    }
}
