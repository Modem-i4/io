<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Models\InventoryDepartment;
use App\Models\InventoryDepartment;
use App\Repositories\InventoryDepartmentRepository;
use Illuminate\Support\Facades\DB;

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
        $items = $this->inventoryDepartmentRepository->getAll1();

        return $items;
    }
    public function index1()
    {
        $items = $this->inventoryDepartmentRepository->getAll1();

       /* $order = 'asc';
        $items = InventoryDepartment::join('inventory_departments as ide', 'inventory_departments.parent_id', '=', 'ide.id')
            ->orderBy('ide.title', $order)
            ->select('inventory_departments.*')
            ->paginate(10);*/


       /* $departments = InventoryDepartment::with('parentDepartment:id,title')->get()
            ->sortBy(function($department) {
                return $department->parentDepartment->title;
            })->take(10);*/

        return $items;
        //return $departments;

    }
}
