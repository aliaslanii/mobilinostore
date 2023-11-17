<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titlegroups extends Model
{
    use HasFactory;

    public function Groups()
    {
        return $this->hasMany(Groups::class)->get();
    }
    public function Category()
    {
        return $this->belongsTo(Category::class)->first();
    }
    public function Products()
    {
        return $this->belongsToMany(Products::class);
    }
}
