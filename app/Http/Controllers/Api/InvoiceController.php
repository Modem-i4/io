<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryInvoiceCreateRequest;
use App\Models\InventoryInvoice;
use App\Models\InventoryItem;
use App\Models\InventoryLicense;
use App\Repositories\InventoryInvoiceRepository;
use App\Repositories\InventoryItemRepository;
use App\Repositories\InventoryLicenseRepository;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * @var InventoryInvoiceRepository
     */
    private $inventoryInvoiceRepository;

    /**
     * @var InventoryItemRepository
     */
    private $inventoryItemRepository;

    /**
     * @var InventoryLicenseRepository
     */
    private $inventoryLicenseRepository;

    public function __construct()
    {
        $this->inventoryInvoiceRepository = app(InventoryInvoiceRepository::class);
        $this->inventoryItemRepository = app(InventoryItemRepository::class);
        $this->inventoryLicenseRepository = app(InventoryLicenseRepository::class);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->inventoryInvoiceRepository->getAllWithRelationsAndPaginate();

        return $items;
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
        $invoice = $this->inventoryInvoiceRepository->getFullDataById($id);

        abort_if(empty($invoice), 404);

        $items = $this->inventoryItemRepository->getAllWithRelationsByInvoiceId($id);
        $licenses = $this->inventoryLicenseRepository->getAllWithRelationsByInvoiceId($id);

        $response = [
            'invoice' => $invoice,
            'items' => $items,
            'licenses' => $licenses
        ];

        return $response;
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
