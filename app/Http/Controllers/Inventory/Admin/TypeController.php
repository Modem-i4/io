<?php

namespace App\Http\Controllers\Inventory\Admin;

class TypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('inventory.admin.types');
    }
}
