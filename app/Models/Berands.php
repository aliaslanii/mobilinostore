<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berands extends Model
{
    use HasFactory;

    public function Categorys()
    {
        return $this->belongsToMany(Category::class);
    }
}
