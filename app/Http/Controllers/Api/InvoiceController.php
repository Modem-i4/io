<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryInvoiceCreateRequest;
use App\Models\InventoryInvoice;
use App\Models\InventoryItem;
use App\Models\InventoryLicense;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryInvoiceCreateRequest $request)
    {
        $data = $request->input();    //TODO: Rename invoice data parameter
        $items = $data["items"];
        $licenses = $data["licenses"];

        $invoice = InventoryInvoice::create($data['data']);

        foreach ($items as $item) {
            $item['invoice_id'] = $invoice->id;
            $item['status_id'] = 1;

            InventoryItem::create($item);
        }

        foreach ($licenses as $license) {
            $license['invoice_id'] = $invoice->id;

            InventoryLicense::create($license);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
