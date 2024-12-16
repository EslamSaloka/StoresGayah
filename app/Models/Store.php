<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function companies() {
        return $this->belongsToMany(\App\Models\Shipping::class, 'user_companies_pivot', 'user_id' ,'company_id')->withPivot("price");
    }

}
