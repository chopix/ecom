<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackagePrice extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'country_code', 'price'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
