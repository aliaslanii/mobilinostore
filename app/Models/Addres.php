<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addres extends Model
{
    use HasFactory;

    public function states()
    {
        return $this->belongsTo(State::class)->first();
    }
    public function cities()
    {
        return $this->belongsTo(City::class)->first();
    }
    public function user()
    {
        return $this->belongsTo(user::class)->first();
    }
}
