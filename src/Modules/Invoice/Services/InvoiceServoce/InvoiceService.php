<?php

namespace Modules\Invoice\Services\InvoiceServoce;

use Modules\Invoice\Classes\InvoiceItem;
use Modules\Invoice\Classes\PricingService;
use Modules\Invoice\Entities\Invoice;
use Modules\Invoice\Events\EditInvoiceEvent;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Invoice\Events\NewInvoiceEvent;
use Modules\Invoice\Services\InvoiceServoce\Requests\EditInvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\Requests\NewInvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\Requests\RemoveInvoiceRequest;
use Modules\Invoice\Services\InvoiceServoce\Responses\NewInvoiceResponse;
use Modules\Product\Entities\Product;

/**
 * @property integer $totalAmount
 * @property string $items
 */
class InvoiceService
{
    /**
     * @throws \Exception
     */
    public function newInvoice(NewInvoiceRequest $request): NewInvoiceResponse
    {
        $totalAmount = 0;
        $customerId = $request->customerId;
        $invoiceModel = new Invoice();

        $invoiceItems = [];
        $this->eachInvoiceItem($request->products, function (InvoiceItem $item) use ($customerId, &$totalAmount, &$invoiceModel, &$invoiceItems) {
            $invoiceModel = $invoiceModel->query()->create([
                'customer_id' => $customerId
            ]);
            $invoiceItems[] = $invoiceModel->invoiceItem()->create([
                'product_id' => $item->productId,
                'quantity' => $item->quantity,
                'price' => $item->price_per_unit,
                'amount' => PricingService::applyQuantity($item->price_per_unit, $item->quantity, 0),
                'discount' => $item->discount,
                'total_after_discount' => $item->calculateTotalAfterDiscount(),
                'tax' => $item->tax,
                'total_amount' => $item->sub_total_price,
            ]);
            $totalAmount += $item->sub_total_price;

        });

        $invoiceModel->total_amount = $totalAmount;
        $invoiceModel->save();

        event(new NewInvoiceEvent($invoiceModel));

        return new NewInvoiceResponse($invoiceModel->customer, $invoiceModel, $invoiceItems);

    }


    public function editInvoice(EditInvoiceRequest $request): NewInvoiceResponse
    {
        $totalAmount = 0;
        $invoiceModel = new Invoice();
        $invoiceId = $request->invoice;
        $invoiceItems = [];
        $this->eachInvoiceItem($request->products, function (InvoiceItem $item) use ($invoiceId, &$totalAmount, &$invoiceModel, &$invoiceItems) {
            $invoiceModel = $invoiceModel->query()->findOrFail($invoiceId);
            $invoiceItems[] = $invoiceModel->invoiceItem()->updateOrCreate(
                [
                    'product_id' => $item->productId
                ], [
                'product_id' => $item->productId,
                'quantity' => $item->quantity,
                'price' => $item->price_per_unit,
                'amount' => PricingService::applyQuantity($item->price_per_unit, $item->quantity, 0),
                'discount' => $item->discount,
                'total_after_discount' => $item->calculateTotalAfterDiscount(),
                'tax' => $item->tax,
                'total_amount' => $item->sub_total_price,
            ]);
            $totalAmount += $item->sub_total_price;

        });

        $invoiceModel->total_amount = $totalAmount;
        $invoiceModel->save();

        event(new EditInvoiceEvent($invoiceModel));

        return new NewInvoiceResponse($invoiceModel->customer, $invoiceModel, $invoiceItems);

    }

    public function removeInvoice(RemoveInvoiceRequest $request)
    {
        $invoice = $request->invoice;
        foreach ($invoice->invoiceItem()->get() as $item) {
            event(new EditRollbackInvoiceEvent($item));
        }
        $invoice->delete();
    }

    /**
     * @return InvoiceItemService
     * @throws \Exception
     */
    public function eachInvoiceItem($products, callable $callback)
    {
        foreach ($products as $item) {

            $product = Product::query()->findOrFail($item['id']);

            $invoiceItem = (new InvoiceItem())
                ->quantity($item['quantity'])
                ->productModel($product)
                ->validate()
                ->calculate(2);
            $callback($invoiceItem);
        }

    }
//    /**
//     * @throws \Exception
//     */
//    public function newInvoice($customerId, $productId, $quantity)
//    {
//        $product = Product::query()->findOrFail($productId);
//
//        $invoiceItem = (new InvoiceItem())
//            ->quantity($quantity)
//            ->discountByPercent($product->discount)
//            ->pricePerUnit($product->price)
//            ->taxByPercent($product->tax)
//            ->validate()
//            ->calculate(2);
//
//        info(collect($invoiceItem));
//    }
}
