@extends('voyager::master')

@section('page_title', 'Opened Tickets')

@section('content')
    <h1>Opened Tickets</h1>

    <div class="row">
      @foreach ($openedTickets as $ticket)
        <a href="{{route('admin.tickets.show', $ticket->id)}}" class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Ticket #{{$ticket->id}}: {{ $ticket->title }}
                        @if ($ticket->unreadedTicketsCount())
                            <span class="badge rounded-circle bg-danger">
                                {{$ticket->unreadedTicketsCount()}}
                            </span>
                        @endif
                    </h5>
                </div>
            </div>
        </a>
      @endforeach
      @if ($openedTickets->lastPage() > 1)
          <ul class="pagination justify-content-center mt-4">
              @if ($openedTickets->currentPage() > 1)
                  <li class="page-item">
                      <a class="page-link" href="{{ $openedTickets->previousPageUrl() }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
              @endif

              @php
                  $maxPages = 5;
                  $halfMaxPages = floor($maxPages / 2);
                  $startPage = max(1, $openedTickets->currentPage() - $halfMaxPages);
                  $endPage = min($openedTickets->lastPage(), $openedTickets->currentPage() + $halfMaxPages);
              @endphp

              @for ($i = $startPage; $i <= $endPage; $i++)
                  <li class="page-item {{ $i == $openedTickets->currentPage() ? 'active' : '' }}">
                      <a class="page-link" href="{{ $openedTickets->url($i) }}">{{ $i }}</a>
                  </li>
              @endfor

              @if ($openedTickets->currentPage() < $openedTickets->lastPage())
                  <li class="page-item">
                      <a class="page-link" href="{{ $openedTickets->nextPageUrl() }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              @endif
          </ul>
      @endif

    </div>
@endsection