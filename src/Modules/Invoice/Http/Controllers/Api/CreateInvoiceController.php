<?php

namespace Modules\Invoice\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Invoice\Http\Requests\InvoiceRequest;

class CreateInvoiceController extends Controller
{
    public function __invoke(InvoiceRequest $request)
    {
    }
}
