<?php

namespace Modules\Invoice\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Events\EditInvoiceEvent;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Invoice\Events\NewInvoiceEvent;
use Modules\Invoice\Listeners\EditInvoiceInventoryUpdate;
use Modules\Product\Entities\Product;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'price',
        'amount',
        'discount',
        'total_after_discount',
        'tax',
        'total_amount'
    ];

    protected static function newFactory()
    {
        return \Modules\Invoice\Database\factories\InvoiceItemFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }


    protected static function booted()
    {
        //    add previous  quantity to inventory
        static::updating(function ($item) {
            event(new EditRollbackInvoiceEvent($item->getOriginal()));
        });

        //    decrement product inventory
        static::updated(function ($item) {
            event(new NewInvoiceEvent($item->invoice));
        });
//        static:
    }
}
