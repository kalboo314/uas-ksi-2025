<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['buyer_id', 'house_id', 'date', 'total_price'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
