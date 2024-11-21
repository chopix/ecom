<?php

namespace App\Models;

use App\Models\Product;
use App\Scopes\CartActiveProductScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new CartActiveProductScope);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
