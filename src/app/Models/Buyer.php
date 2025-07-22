<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Buyer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function getEmailAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = Crypt::encryptString($value);
    }

    public function getPhoneAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
