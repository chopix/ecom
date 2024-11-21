<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Ticket;
use App\Models\UnreadTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTicketController extends Controller
{

    public function main()
    {
        $unreadedTicketsCount = Ticket::all()
                                ->sum(function($ticket) {
                                    return $ticket->unreadedTicketsCount();
                                });

        return view("voyager::tickets.index", compact('unreadedTicketsCount'));
    }

    public function gitTicket(Request $request)
    {
        $ticket = Ticket::find($request->id);

        if(!$ticket) {
            return back()->withErrors(['ticket' => 'Ticket not found']);
        }

        return redirect()->route('admin.tickets.show', $ticket->id);
    }

    public function showTheTicket($id)
    {
        $ticket = Ticket::with('responses.user')->findOrFail($id);
        $responses =  $ticket->responses;

        UnreadTicket::where('ticket_id', $ticket->id)
                    ->where('user_id', '!=', auth()->id())
                    ->update([
                        'count' => 0,
                    ]);
        
        return view("voyager::tickets.read", compact('ticket', 'responses'));
    }

    public function getClosedTickets()
    {
        $closedTickets = Ticket::with('responses.user')
                            ->orderByDesc('created_at')
                            ->where('is_closed', true)
                            ->paginate(20);

        return view("voyager::tickets.closed", compact('closedTickets'));
    }

    public function getOpenedTickets()
    {
        $openedTickets = Ticket::with('responses.user')
                            ->orderByDesc('created_at')
                            ->where('is_closed', false)
                            ->paginate(20);

        return view("voyager::tickets.opened", compact('openedTickets'));
    }

}
