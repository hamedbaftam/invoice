<?php

namespace Modules\Invoice\Http\Controllers;

use App\utils\ApiResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Invoice\Entities\Invoice;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Invoice\Http\Requests\InvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\InvoiceService;
use Modules\Invoice\Services\InvoiceServoce\Requests\EditInvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\Requests\NewInvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\Requests\RemoveInvoiceRequest;
use Modules\Invoice\Transformers\InvoiceCollection;
use Modules\Invoice\Transformers\InvoiceResource;

class InvoiceController extends Controller
{

    public function __construct(protected InvoiceService $invoiceService)
    {
    }


    public function index()
    {
        $items = Invoice::query()->with('customer', 'invoiceItem')->get();

        return (new ApiResponse(new InvoiceCollection($items), 'ok'))->success();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InvoiceRequest $request)
    {
        $products = $request->get('products');
        $customerId = $request->get('customerId');

        $invoice = $this->invoiceService->newInvoice(new NewInvoiceRequest($customerId, $products));

        return (new ApiResponse(new InvoiceResource($invoice), 'ok'))->success();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('invoice::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('invoice::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InvoiceRequest $request, $id)
    {
        $products = $request->get('products');
        $customerId = $request->get('customerId');

        $invoice = $this->invoiceService->editInvoice(new EditInvoiceRequest($id, $products));
        return (new ApiResponse(new InvoiceResource($invoice), 'ok'))->success();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Invoice $invoice)
    {
        $this->invoiceService->removeInvoice(new RemoveInvoiceRequest($invoice));
        return (new ApiResponse([], 'Invoice has been deleted'))->success();
    }
}
