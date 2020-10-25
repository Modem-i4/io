<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryTypeCreateRequest;
use App\Http\Requests\InventoryTypeDeleteRequest;
use App\Http\Requests\InventoryTypeUpdateRequest;
use App\Models\InventoryType;
use App\Repositories\InventoryTypeRepository;

class TypeController extends Controller
{
    /**
     * @var InventoryTypeRepository
     */
    private $inventoryTypeRepository;

    public function __construct()
    {
        $this->inventoryTypeRepository = app(InventoryTypeRepository::class);

    }

    public function index()
    {
        $items = $this->inventoryTypeRepository->getAllWithPaginateAndFiltering();

        return $items;
    }

    public function update(InventoryTypeUpdateRequest $request, $id)
    {
        $item = $this->inventoryTypeRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $result = $item->update($request->input());

    }

    public function store(InventoryTypeCreateRequest $request)
    {
        $result = InventoryType::insert($request->input());
    }

    public function destroyMany(InventoryTypeDeleteRequest $request)
    {
        $idList = $request->input('idList');
        InventoryType::destroy($idList);

    }

}
