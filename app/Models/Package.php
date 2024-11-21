<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PackagePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    public function prices()
    {
        return $this->hasMany(PackagePrice::class);
    }

    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
