<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 
        'address_id',
        'pickup_date',
        'pickup_time', 
        'delivery_date',
        'delivery_time',
        'delivered_by',
        'payment_mode',
        'order_id',
        'other_requests',
        'collection_instructions',
        'delivery_instructions',
        'status',
        'created_at',
        'updated_at'
    ];
}
