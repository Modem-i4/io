<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryProviderCreateRequest;
use App\Http\Requests\InventoryProviderDeleteRequest;
use App\Http\Requests\InventoryProviderUpdateRequest;
use App\Models\InventoryProvider;
use App\Repositories\InventoryProviderRepository;

class ProviderController extends Controller
{
    /**
     * @var InventoryProviderRepository
     */
    private $inventoryProviderRepository;

    public function __construct()
    {
        $this->inventoryProviderRepository = app(InventoryProviderRepository::class);

    }

    public function index()
    {
        $items = $this->inventoryProviderRepository->getAllWithPaginateAndFiltering();

        return $items;
    }

    public function update(InventoryProviderUpdateRequest $request, $id)
    {
        $item = $this->inventoryProviderRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $item->update($request->input());

    }

    public function store(InventoryProviderCreateRequest $request)
    {
        InventoryProvider::insert($request->input());
    }

    public function destroyMany(InventoryProviderDeleteRequest $request)
    {
        $idList = $request->input('idList');
        InventoryProvider::destroy($idList);

    }

}
