<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productable_id',
        'productable_type',
    ];

    /**
     * Get the parent productable model (tool, package, or Paddle product).
     */
    public function productable()
    {
        return $this->morphTo();
    }

    /**
     * Scope to get active tools.
     */
    public function scopeActiveTools($query)
    {
        return $query->whereHasMorph('productable', [Tool::class], function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Scope to get active packages.
     */
    public function scopeActivePackages($query)
    {
        return $query->whereHasMorph('productable', [Package::class], function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Scope to get active Paddle products.
     */
    public function scopeActivePaddleProducts($query)
    {
        return $query->whereHasMorph('productable', [PaddleProduct::class], function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Define the relationship with Cart.
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Define the relationship with PlanSubscription.
     */
    public function subscriptions()
    {
        return $this->hasMany(PlanSubscription::class);
    }
}