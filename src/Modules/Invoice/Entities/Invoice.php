<?php

namespace Modules\Invoice\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customer\Entities\Customer;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_amount'
    ];

    protected static function newFactory()
    {
        return \Modules\Invoice\Database\factories\InvoiceFactory::new();
    }

    public function invoiceItem()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
