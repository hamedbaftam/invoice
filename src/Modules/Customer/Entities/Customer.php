<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'demonstration_name',
        'active',
        'first_name',
        'last_name',
        'social_id',
        'birthday',
        'mobile_number',
        'mobile_number_description',
        'email',
        'email_description',
    ];

    protected static function newFactory()
    {
        return \Modules\Customer\Database\factories\CustomerFactory::new();
    }
}
