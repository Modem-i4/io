<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryDepartmentDeleteRequest;
use App\Http\Requests\InventoryDepartmentUpdateRequest;
use App\Models\InventoryDepartment;
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
        $items = $this->inventoryDepartmentRepository->getAllWithParents();

        return $items;
    }

    public function all()
    {
        $items = $this->inventoryDepartmentRepository->getAllForList();

        return $items;
    }

    public function update(InventoryDepartmentUpdateRequest $request, $id)
    {
        $item = $this->inventoryDepartmentRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $result = $item->update($request->input());

    }

    public function store(InventoryDepartmentUpdateRequest $request)
    {
/*
        $item = new InventoryDepartment();
        $item->title = $request->input('title');
        $item->parent_id = $request->input('parent_id');

        $item->save();
*/
        $result = InventoryDepartment::insert($request->input());
    }

    public function destroyMany(InventoryDepartmentDeleteRequest $request)    //TODO: Create InventoryDepartmentDestroyManyRequest
    {
        $idList = $request->input('idList');
        $result = $this->inventoryDepartmentRepository->getByIdListWithChildCount($idList);

        $itemsWhichHasChildren = $result->filter(function($value, $key) {
            return $value->children_count !== 0;
        });

        if($itemsWhichHasChildren->isEmpty()) {
            InventoryDepartment::destroy($idList);
        }
        else {
            return response()->json([
                'message' => 'Вибрані елементи мають дочірні компоненти',
                'errors' => [],    //TODO: Add errors
            ], 422);
        }

    }

}
