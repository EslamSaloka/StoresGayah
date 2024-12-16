<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = "e_sliders";

    protected $fillable = [
        'store_id',
        'image',
    ];

    public function getDisplayImageAttribute() {
        return env('APP_SYSTEM_URL').'/'.$this->image;
    }

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

}
