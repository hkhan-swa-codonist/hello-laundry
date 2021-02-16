<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $fillable = [
        'id', 'order_id', 'service_id','category_id', 'created_at', 'updated_at'
    ];
}
