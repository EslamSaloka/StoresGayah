<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "e_categories";

    protected $fillable = [
        'store_id',
        'name',
        'parent_id',
        'image',
    ];

    public function getDisplayImageAttribute() {
        return env('APP_SYSTEM_URL').'/'.$this->image;
    }

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function children() {
        return $this->hasMany(self::class,"parent_id","id");
    }

    public function parent() {
        return $this->hasOne(self::class,"id","parent_id");
    }

}
