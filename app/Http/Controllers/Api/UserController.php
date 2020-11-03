<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryUserCreateRequest;
use App\Http\Requests\InventoryUserDeleteRequest;
use App\Http\Requests\InventoryUserUpdateRequest;
use App\Models\InventoryType;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $inventoryUserRepository;

    public function __construct()
    {
        $this->inventoryUserRepository = app(UserRepository::class);

    }
    public function index()
    {
        $items = $this->inventoryUserRepository->getAllWithPaginateAndFiltering();

        return $items;
    }

    public function all()
    {
        $items = $this->inventoryUserRepository->getAllForList();

        return $items;
    }

    public function update(InventoryUserUpdateRequest $request, $id)
    {
        $item = $this->inventoryUserRepository->getForEdit($id);
        abort_if(empty($item), '404');

        $result = $item->update($request->input());

    }

    public function store(InventoryUserCreateRequest $request)
    {
        $result = User::insert($request->input());
    }

    public function destroyMany(InventoryUserDeleteRequest $request)
    {
        $idList = $request->input('idList');
        User::destroy($idList);

    }

}
