<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    public function Baskets()
    {
        return $this->belongsTo(Baskets::class)->first();
    }

    public function invoiceProducts()
    {
        return $this->hasMany(invoiceProducts::class)->get();
    }
}
