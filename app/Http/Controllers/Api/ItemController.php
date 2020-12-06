<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        $items = $this->inventoryItemRepository->getAllWithRelationsAndPaginate();

        return $items;
    }
}
