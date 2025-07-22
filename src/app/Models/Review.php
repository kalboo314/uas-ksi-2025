<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['buyer_id', 'house_id', 'rating', 'comment'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
