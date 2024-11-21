<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Product;
use App\Models\PlanSubscriptionPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'started_at', 'active', 'expires_at', 'payment_id'];

    protected $dates = [
        'expires_at',
        'started_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(
            Payment::class,
            PlanSubscriptionPayment::class,
            'plan_subscription_id',
            'id', 
            'id', 
            'payment_id' 
        );
    }

}
