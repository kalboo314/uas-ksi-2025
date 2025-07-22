<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = ['seller_id', 'title', 'description', 'address', 'price', 'land_area', 'building_area'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
