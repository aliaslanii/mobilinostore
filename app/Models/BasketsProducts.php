<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketsProducts extends Model
{
    use HasFactory;

    public function Products()
    {
        return $this->belongsTo(Products::class)->first();
    }
    public function Color()
    {
        return $this->belongsTo(Colors::class)->first();
    }
    public function Baskets()
    {
        return $this->belongsTo(Baskets::class)->first();
    }
    
}
