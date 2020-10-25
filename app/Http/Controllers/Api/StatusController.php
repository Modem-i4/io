<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryStatusCreateRequest;
use App\Http\Requests\InventoryStatusDeleteRequest;
use App\Http\Requests\InventoryStatusUpdateRequest;
use App\Models\InventoryStatus;
use App\Repositories\InventoryStatusRepository;

class StatusController extends Controller
{
    /**
     * @var InventoryStatusRepository
     */
    private $inventoryStatusRepository;

    public function __construct()
    {
        $this->inventoryStatusRepository = app(InventoryStatusRepository::class);

    }

    public function index()
    {
        $items = $this->inventoryStatusRepository->getAllWithPaginateAndFiltering();

        return $items;
    }

    public function update(InventoryStatusUpdateRequest $request, $id)
    {
        $item = $this->inventoryStatusRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $result = $item->update($request->input());

    }

    public function store(InventoryStatusCreateRequest $request)
    {
        $result = InventoryStatus::insert($request->input());
    }

    public function destroyMany(InventoryStatusDeleteRequest $request)
    {
        $idList = $request->input('idList');
        InventoryStatus::destroy($idList);

    }

}
