<?php

namespace App\Http\Livewire\Main\Tickets;

use App\Models\Ticket;
use Livewire\Component;

class AllTickets extends Component
{
    public $closedTicket = [];
    public $openedTickets = [];

    public function mount()
    {
        $allTickets = Ticket::with('responses.user')
                    ->where('user_id', auth()->id())
                    ->orderByDesc('created_at')
                    ->get();

        $this->openedTickets = $allTickets->filter(function ($ticket) {
            return $ticket->is_closed;
        });

        $this->closedTicket = $allTickets->filter(function ($ticket) {
            return !$ticket->is_closed;
        });

    }

    public function render()
    {
        return view('livewire.main.tickets.all-tickets')->layout('components.layouts.dash', ['title' => 'My tickets']);
    }
}
