<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "e_clients";

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'otp',
        'avatar',
        'phone_verified_at',
        'store_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"avatar");
    }

    public function notifications() {
        return $this->hasMany(\App\Models\Notification::class,"client_id","id");
    }

    public function cart() {
        return $this->hasOne(\App\Models\Cart::class,"client_id","id");
    }

    public function advFav() {
        return $this->hasMany(\App\Models\Product\Fav::class,"client_id","id");
    }
}
