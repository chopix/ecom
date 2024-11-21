<?php

namespace App\Models;

use App\Models\Affiliate;
use Laravel\Paddle\Billable;
use App\Models\AffiliateLink;
use Laravel\Sanctum\HasApiTokens;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\NewDeviceLoggedInNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone_number',
        'full_name',
        'company_name',
        'vat_number',
        'address',
        'town_city',
        'state_country',
        'postcode',
        'country',
        'is_business',
        'permissions',
        'location',
        'ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function affiliateLink()
    {
        return $this->hasOne(AffiliateLink::class, 'user_id');
    }
    
    public function getAffiliateLink()
    {
        if ($this->affiliateLink) {
                return $this->affiliateLink->affiliate_link;
        }

        return null;
    }

    public function referredByAffiliates()
    {
        return $this->hasMany(Affiliate::class, 'referred_user_id');
    }

    public function sendPasswordResetNotification($token) 
    {
        $this->notify(new ResetPasswordNotification($token, $this->name));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendNewDeviceLoggedInNotification($ip, $device, $platform, $date)
    {
        $this->notify(new NewDeviceLoggedInNotification($ip, $device, $platform, $date));
    }
}
