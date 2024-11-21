@extends('voyager::master')

@section('page_title', 'Affiliates')

@section('content')
  <h1>Available Subscriptions</h1>
  <table class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>#</th>
              <th>User</th>
              <th>Product</th>
              <th>Started At</th>
              <th>Expires At</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($subs as $sub)
                <tr>
                    <td>{{$sub->id}}</td>
                    <td><a href="{{route('voyager.users.show', $sub->user_id)}}">{{$sub->user->name?? ''}}</a></td>
                    <td>
    @if(null !== ($sub->product->productable->title ?? null))
        {{$sub->product->productable->title ?? ''}}
    @endif
</td>
                    <td>{{$sub->started_at}}</td>
                    <td>{{$sub->expires_at}}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
@endsection