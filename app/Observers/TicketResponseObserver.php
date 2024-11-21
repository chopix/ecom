<?php

namespace App\Observers;

use App\Models\UnreadTicket;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\DB;

class TicketResponseObserver
{
    /**
     * Handle the TicketResponse "created" event.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return void
     */
    public function created(TicketResponse $ticketResponse)
    {
        $ticket = $ticketResponse->ticket;
        
        UnreadTicket::updateOrCreate(
            ['ticket_id' => $ticket->id], 
            [
                'count' => DB::raw('IFNULL(count, 0) + 1'),
                'user_id' => auth()->id(),
            ]
        );
    }

    /**
     * Handle the TicketResponse "updated" event.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return void
     */
    public function updated(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Handle the TicketResponse "deleted" event.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return void
     */
    public function deleted(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Handle the TicketResponse "restored" event.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return void
     */
    public function restored(TicketResponse $ticketResponse)
    {
        //
    }

    /**
     * Handle the TicketResponse "force deleted" event.
     *
     * @param  \App\Models\TicketResponse  $ticketResponse
     * @return void
     */
    public function forceDeleted(TicketResponse $ticketResponse)
    {
        //
    }
}
