<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = "e_address";

    protected $fillable = [
        'store_id',
        'client_id',
        'shipping_by',
        'title',
        'city',
        'address',
        'postcode',
        'phone',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

}
