<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketResponse extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id', 'content', 'images', 'user_id'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
