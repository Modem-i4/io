<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Models\InventoryDepartment;
use App\Repositories\InventoryDepartmentRepository;

class DepartmentController extends Controller
{
    /**
     * @var InventoryDepartmentRepository
     */
    private $inventoryDepartmentRepository; // властивість через яку будемо звертатись в репозиторій

    public function __construct()
    {
        //$this->middleware('auth');
        $this->inventoryDepartmentRepository = app(InventoryDepartmentRepository::class); //app вертає об'єкт класа

    }

    public function index()
    {
        $items = $this->inventoryDepartmentRepository->getAll();

        return $items;
    }
}