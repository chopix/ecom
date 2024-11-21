<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaddleProduct extends Model
{
    use HasFactory;

    protected $fillable = ['paddle_product_id', 'name', 'price', 'currency'];
}