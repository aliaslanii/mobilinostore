<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baskets extends Model
{
    use HasFactory;

    public function BasketsProducts()
    {
        return $this->hasMany(BasketsProducts::class)->get();
    }
    public function User()
    {
        return $this->belongsTo(User::class)->first();
    }
    public function Addres()
    {
        return $this->belongsTo(Addres::class)->first();
    }
}
