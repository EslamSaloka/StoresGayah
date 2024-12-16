<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenancy extends Model
{
    use HasFactory;

    protected $table = "e_tenancy";

    protected $fillable = [
        'domain_name',
        'store_id',
    ];

    public function store() {
        return $this->hasOne(\App\Models\Store::class,"id","store_id");
    }

}
