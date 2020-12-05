<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\InventoryLicenseRepository;

class LicenseController extends Controller
{
    /**
     * @var InventoryLicenseRepository
     */
    private $inventoryLicenseRepository;

    public function __construct()
    {
        $this->inventoryLicenseRepository = app(InventoryLicenseRepository::class);

    }

    public function index()
    {
        $items = $this->inventoryLicenseRepository->getAllWithRelationsAndPaginate();
        //dump($items);
        return $items;
    }
}
