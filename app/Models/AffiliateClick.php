<?php

namespace App\Models;

use App\Models\AffiliateLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateClick extends Model
{
    use HasFactory;

    protected $fillable = ['affiliate_link_id', 'ip'];

    public function affiliateLink()
    {
        return $this->belongsTo(AffiliateLink::class);
    }
}
