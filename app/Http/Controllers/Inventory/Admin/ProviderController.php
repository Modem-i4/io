<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('inventory.admin.providers');
    }
}
