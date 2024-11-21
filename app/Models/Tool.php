<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ToolPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    public function prices()
    {
        return $this->hasMany(ToolPrice::class);
    }
    
    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
