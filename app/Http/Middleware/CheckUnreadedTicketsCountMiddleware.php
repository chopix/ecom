<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ticket;
use App\Models\UnreadTicket;
use Illuminate\Http\Request;

class CheckUnreadedTicketsCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()) {
            $unreadedTicketsCount = Ticket::where('user_id', auth()->id())
                                ->get()
                                ->sum(function($ticket) {
                                    return $ticket->unreadedTicketsCount();
                                });
            
            session(['unreaded_tickets' => $unreadedTicketsCount]);
        }

        return $next($request);
    }
}
