<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = "e_contacts";

    protected $fillable = [
        'store_id',
        'name',
        'phone',
        'email',
        'message',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

}
