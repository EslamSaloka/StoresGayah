<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

// Shipping
use App\Shipping\Aramex;
use App\Shipping\Smsa;

class Shipping extends Model
{
    use HasFactory;

    protected $table = "shipping";

    protected $fillable = [
        'user_id',
        'shipping_by',
        'store',
        'customer',
        'tracking_id',
        'status',
        'weight',
        'pcs',
        'my',
        'cod_price',
        'total',
        'description',
        'cod_price',
        'type',
        'is_process',
    ];

    protected $casts = [
        'store'         => 'array',
        'customer'      => 'array',
    ];
}
