<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\InventoryRepairRepository;

class RepairController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('inventory.admin.repairs');
    }
}
