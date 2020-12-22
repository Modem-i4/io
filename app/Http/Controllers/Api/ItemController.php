<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryItemStatusUpdateRequest;
use App\Repositories\InventoryItemRepository;

class ItemController extends Controller
{
    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;

    public function __construct()
    {
        $this->inventoryItemRepository = app(InventoryItemRepository::class);

    }

    public function getForEdit($id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->first();
    }

    public function index()
    {
        $items = $this->inventoryItemRepository->getAllWithRelationsAndPaginate();

        return $items;
    }

    public function all()
    {
        $items = $this->inventoryItemRepository->getAllForList();

        return $items;
    }
    public function update(InventoryItemStatusUpdateRequest $request, $id)
    {
        $item = $this->inventoryItemRepository->getForEdit($id);
        abort_if(empty($item), '404');
        $result = $item->update($request->input());
    }
}
