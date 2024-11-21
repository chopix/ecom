<?php

namespace App\Http\Livewire\Main\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Storage;

class CreateTicket extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $photos = [];
    public $submitted;
    public $imagesAreUploading = false;

    public function submit()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:16384'
        ]);

        $photosPaths = null;

        foreach (array_slice($this->photos, 0, 5) as $photo) {
            $photoPath = $photo->store('tickets', 'public'); 
            $photosPaths[] = Storage::url($photoPath); 
        }

        $ticket = Ticket::create([
            'title' => $this->title,
            'user_id' => auth()->id(),
        ]);

        TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'content' => $this->content,
            'images' => $photosPaths ? json_encode($photosPaths) : null,
        ]);

        $this->submitted = "Your ticket #{$ticket->id} is successfully created!";

        $this->reset(['title', 'content', 'photos']);
    }

    public function updatedPhotos()
    {
        $this->photos = array_slice($this->photos, 0, 5);
    }


    public function render()
    {
        return view('livewire.main.tickets.create-ticket')->layout('components.layouts.dash', ['title' => 'Create a ticket']);
    }
}
