<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Repositories\InventoryDepartmentRepository;


class DepartmentController extends BaseController
{
    /**
     * @var InventoryDepartmentRepository
     */
    private $inventoryDepartmentRepository; // властивість через яку будемо звертатись в репозиторій

    public function __construct()
    {
        parent::__construct(); //конструктор від парента на перспективу, можливо колись знадобиться
        $this->inventoryDepartmentRepository = app(InventoryDepartmentRepository::class); //app вертає об'єкт класа

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.admin.departments');

    }

}
