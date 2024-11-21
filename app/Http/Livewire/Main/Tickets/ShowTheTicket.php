<?php

namespace App\Http\Livewire\Main\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\UnreadTicket;
use Livewire\WithFileUploads;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Storage;

class ShowTheTicket extends Component
{
    use WithFileUploads;

    public $responses = [];
    public $photos = [];
    public $content;
    public Ticket $ticket;

    public function mount($id)
    {
        $this->ticket = Ticket::with(['responses.user', 'user'])->findOrFail($id);

        if(auth()->id() !== $this->ticket->user->id) {
            abort(404);
        }

        UnreadTicket::where('ticket_id', $this->ticket->id)
                    ->where('user_id', '!=', auth()->id())
                    ->update([
                        'count' => 0,
                    ]);

        $this->responses = $this->ticket->responses;
    }

    protected function reloadResponses($response) 
    {
        $this->responses[] = $response;
    }

    public function updatedPhotos()
    {
        $this->photos = array_slice($this->photos, 0, 5);
    }

    public function closeTicket()
    {
        $this->ticket->is_closed = true;
        $this->ticket->save();
    }

    public function submit()
    {
        $this->validate([
            'content' => 'required|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:16384'
        ]);

        $photosPaths = null;

        foreach (array_slice($this->photos, 0, 5) as $photo) {
            $photoPath = $photo->store('tickets', 'public'); 
            $photosPaths[] = Storage::url($photoPath); 
        }

        $response = TicketResponse::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => auth()->id(),
            'content' => $this->content,
            'images' => $photosPaths ? json_encode($photosPaths) : null,
        ]);

        $this->reloadResponses($response);

        $this->reset(['content', 'photos']);
    }

    public function render()
    {
        return view('livewire.main.tickets.show-the-ticket')->layout('components.layouts.dash', ['title' => "Ticket #{$this->ticket->id}"]);
    }
}
