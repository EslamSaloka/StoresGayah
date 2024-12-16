<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = "shipping_companies";

    protected $fillable = [
        'name',
        'value',
        'price',
    ];

    public function store() {
        return $this->hasOne(\App\Models\Store::class,"id","store_id");
    }

}
