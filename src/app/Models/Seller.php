<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Seller extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    // Enkripsi otomatis saat menyimpan
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

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    public function getAddressAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }
}
