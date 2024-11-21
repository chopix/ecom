@extends('voyager::master')

@section('page_title', 'Closed Tickets')

@section('content')
    <h1>Closed Tickets</h1>

    <div class="row">
      @foreach ($closedTickets as $ticket)
        <a href="{{route('admin.tickets.show', $ticket->id)}}" class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Ticket #{{$ticket->id}}: {{ $ticket->title }}
                    </h5>
                </div>
            </div>
        </a>
      @endforeach
    </div>
    <div class="row text-center">
      @if ($closedTickets->lastPage() > 1)
          <ul class="pagination justify-content-center mt-4">
              @if ($closedTickets->currentPage() > 1)
                  <li class="page-item">
                      <a class="page-link" href="{{ $closedTickets->previousPageUrl() }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                      </a>
                  </li>
              @endif

              @php
                  $maxPages = 5;
                  $halfMaxPages = floor($maxPages / 2);
                  $startPage = max(1, $closedTickets->currentPage() - $halfMaxPages);
                  $endPage = min($closedTickets->lastPage(), $closedTickets->currentPage() + $halfMaxPages);
              @endphp

              @for ($i = $startPage; $i <= $endPage; $i++)
                  <li class="page-item {{ $i == $closedTickets->currentPage() ? 'active' : '' }}">
                      <a class="page-link" href="{{ $closedTickets->url($i) }}">{{ $i }}</a>
                  </li>
              @endfor

              @if ($closedTickets->currentPage() < $closedTickets->lastPage())
                  <li class="page-item">
                      <a class="page-link" href="{{ $closedTickets->nextPageUrl() }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                      </a>
                  </li>
              @endif
          </ul>
      @endif
    </div>
@endsection