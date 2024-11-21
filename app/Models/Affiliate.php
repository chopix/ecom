<?php

namespace App\Models;

use App\Models\User;
use App\Models\AffiliateLink;
use App\Models\AffiliateSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = ['affiliate_link_id', 'referred_user_id'];

    public function affiliateLink()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    public function affiliateSales()
    {
    return $this->hasMany(AffiliateSale::class);
    }
}
