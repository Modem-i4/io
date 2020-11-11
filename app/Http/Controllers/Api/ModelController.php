<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryModelUpdateRequest;
use App\Http\Requests\InventoryModelCreateRequest;
use App\Http\Requests\InventoryModelDeleteRequest;
use App\Models\InventoryModel;
use App\Repositories\InventoryModelRepository;

class ModelController extends Controller
{
    /**
     * @var InventoryModelRepository
     */
    private $inventoryModelRepository;

    public function __construct()
    {
        $this->inventoryModelRepository = app(InventoryModelRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->inventoryModelRepository->getAllWithPaginateAndFiltering();

        return $items;
    }

    public function all()
    {
        $items = $this->inventoryModelRepository->getAllForList();

        return $items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryModelCreateRequest $request)
    {
        $result = InventoryModel::insert($request->input());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryModelUpdateRequest $request, $id)
    {
        $item = $this->inventoryModelRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $result = $item->update($request->input());
    }

    public function destroyMany(InventoryModelDeleteRequest $request)
    {
        $idList = $request->input('idList');
        InventoryModel::destroy($idList);

    }
}
