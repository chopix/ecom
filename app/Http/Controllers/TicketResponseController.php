<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\UnreadTicket;
use Illuminate\Http\Request;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Storage;

class TicketResponseController extends Controller
{
    public function responseToTheTicket(Request $request, $id)
    {
        if($request->has('close')) {
            $ticket = Ticket::find($id);
            $ticket->is_closed = true;
            $ticket->save();

            return back();
        }

        if($request->has('open') && auth()->user()->hasRole('admin')) {
            $ticket = Ticket::find($id);
            $ticket->is_closed = false;
            $ticket->save();

            return back();
        }

        $request->validate([
            'content' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:16384'
        ]);

        $imagesPaths = null;

        if($request->images) {
            foreach (array_slice($request->images, 0, 5) as $photo) {
                if($photo) {
                    $imagePath = $photo->store('public/tickets-responses'); 
                    $imagesPaths[] = Storage::url($imagePath); 
                }
            }
        }

        TicketResponse::create([
            'ticket_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'images' => $imagesPaths ? json_encode($imagesPaths) : null,
        ]);

        return back()->with('message', "The response to the ticket #{$id} has been successfully saved!");
    }
}
