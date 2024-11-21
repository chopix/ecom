<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateSale extends Model
{
    use HasFactory;

    protected $fillable = ['affiliate_id', 'payment_id'];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
