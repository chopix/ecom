@extends('voyager::master')

@section('page_title', 'Tickets')

@section('content')
    <h1>Tickets</h1>

    <div class="row">
        <div class="col-md-6">
            <form action="{{route('admin.tickets.get')}}" style="display: flex; align-items: center;">
                @csrf
                <input type="text" class="form-control" name="id" placeholder="Number of ticket">
                <button class="btn btn-primary">Search</button>
            </form>
            @error('ticket')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <div>
                <a href="{{route('admin.tickets.opened')}}" class="btn btn-primary">
                    Opened tickets
                    @if ($unreadedTicketsCount)
                        <span class="badge rounded-circle bg-danger">{{$unreadedTicketsCount}}</span>
                    @endif
                </a>
            </div>
            <div>
                <a href="{{route('admin.tickets.closed')}}" class="btn btn-primary">Closed tickets</a>
            </div>
        </div>
    </div>
@endsection