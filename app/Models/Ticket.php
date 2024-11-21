<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use App\Models\UnreadTicket;
use App\Models\TicketResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function responses()
    {
        return $this->hasMany(TicketResponse::class);
    }

    public function unreadedTicket()
    {
        return $this->hasOne(UnreadTicket::class);
    }

    public function unreadedTicketsCount()
    {
        if ($this->unreadedTicket && auth()->id() != $this->unreadedTicket->user_id) {
            return $this->unreadedTicket->count;
        }

        return 0;
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
