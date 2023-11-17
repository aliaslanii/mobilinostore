<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['P_id','Name','Price','Number','img','suggested','Description','favorite','Discount','categories_id','size_id','berand_id','is_Delete'];

    public function Berand()
    {
        return $this->belongsTo(Berands::class)->first();
    }
    public function Categories()
    {
        return $this->belongsTo(Category::class)->first();
    }
    public function ColorNumberPrice()
    {
        return $this->hasMany(ColorNumberPrice::class)->get();
    }
    public function SpecificationProducts()
    {
        return $this->hasMany(SpecificationProducts::class)->get();
    }
    public function Images()
    {
        return $this->hasMany(Images::class)->get();
    }
    
    public function Titlegroups()
    {
        return $this->belongsToMany(Titlegroups::class);
    }
    public function Groups()
    {
        return $this->belongsToMany(Groups::class);
    }
    public function Discounts()
    {
        return $this->belongsTo(Discount::class)->first();
    }
    public function Suggestions()
    {
        return $this->belongsTo(Suggestion::class)->first();
    }
    
}
