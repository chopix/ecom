<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanSubscriptionPayment extends Model
{
    use HasFactory;

    protected $table = 'plan_subscriptions_payments';

    protected $fillable = ['plan_subscription_id', 'payment_id'];

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
