<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Requests\InventoryDepartmentUpdateRequest;
use App\Repositories\InventoryDepartmentRepository;
use Response;


class DepartmentController extends BaseController
{
    /**
     * @var InventoryDepartmentRepository
     */
    private $inventoryDepartmentRepository; // властивість через яку будемо звертатись в репозиторій

    public function __construct()
    {
        $this->middleware('auth');
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
        /*$paginator = $this->inventoryDepartmentRepository->getAllWithPaginate(2000);
        $categoryList = $this->inventoryDepartmentRepository->getForComboBox();*/
        return view('inventory.admin.departments');

    }

}
