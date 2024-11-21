<div class="container">
    <h1 class="my-4">My Tickets</h1>

    <a href="{{route('support.tickets.create')}}" class="btn btn-primary mb-4">Create a new ticket</a>

    <div class="card mb-3">
        <div class="card-header bg-success text-white">
            <h2>Opened tickets</h2>
        </div>
        <div class="card-body">
            @foreach ($closedTicket as $ticket)
                <a href="{{route('support.tickets.show', $ticket->id)}}" class="card mb-3 text-decoration-none">
                    <div class="card-header">
                        Ticket #{{$ticket->id}}: {{ $ticket->title }}
                        @if ($ticket->unreadedTicketsCount())
                            <span class="badge rounded-circle bg-danger">
                                {{$ticket->unreadedTicketsCount()}}
                            </span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-danger text-white">
            <h2>Closed tickets</h2>
        </div>
        <div class="card-body">
            @foreach ($openedTickets as $ticket)
                <a href="{{route('support.tickets.show', $ticket->id)}}" class="card mb-3 text-decoration-none">
                    <div class="card-header">
                        Ticket #{{$ticket->id}}: {{ $ticket->title }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>