<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolPrice extends Model
{
    use HasFactory;

    protected $fillable = ['tool_id', 'country_code', 'price'];

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }
}
