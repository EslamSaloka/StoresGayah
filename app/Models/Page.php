<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = "e_pages";

    protected $fillable = [
        'store_id',
        'key',
        'content',
        'image',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function getDisplayImageAttribute() {
        if(is_null($this->image)) {
            return env('APP_SYSTEM_URL')."/".getStoreInformation("logo");
        }
        return env('APP_SYSTEM_URL')."/".$this->image;
    }
}
