<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRepairCreateRequest;
use App\Http\Requests\InventoryRepairDeleteRequest;
use App\Http\Requests\InventoryRepairUpdateEndDateRequest;
use App\Http\Requests\InventoryRepairUpdateRequest;
use App\Models\InventoryRepair;
use App\Repositories\InventoryRepairRepository;

class RepairController extends Controller
{
    /**
     * @var InventoryRepairRepository
     */
    private $inventoryRepairRepository;

    public function __construct()
    {
        $this->inventoryRepairRepository = app(InventoryRepairRepository::class);

    }
    public function index()
    {
        $items = $this->inventoryRepairRepository->getAllWithRelationsAndPaginate();

        return $items;
    }

    public function all()
    {
        $items = $this->inventoryRepairRepository->getAllForList();

        return $items;
    }

    public function update(InventoryRepairUpdateRequest $request, $id)
    {
        $item = $this->inventoryRepairRepository->getForEdit($id);
        abort_if(empty($item), '404');
        $result = $item->update($request->input());
    }

    public function updateEndDate(InventoryRepairUpdateEndDateRequest $request, $item_id)
    {
        $item = $this->inventoryRepairRepository->getForEndDateEdit($item_id);
        abort_if(empty($item), '404');
        $result = $item->update($request->input());
    }
    public function store(InventoryRepairCreateRequest $request)
    {
        $result = InventoryRepair::insert($request->input());
    }

    public function destroyMany(InventoryRepairDeleteRequest $request)
    {
        $idList = $request->input('idList');
        InventoryRepair::destroy($idList);

    }

}
