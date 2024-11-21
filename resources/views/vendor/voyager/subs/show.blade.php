@extends('voyager::master')

@section('page_title', 'Latest Signups')

@section('content')
  <h1> <a href="{{route('voyager.users.show', ['id' => $user->id])}}" style="text-decoration:underline;">{{$user->name}}</a> affiliates</h1>
  <table class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Payment ID</th>
              <th>User ID</th>
              <th>Transaction date</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($affLinks as $affLink)
            @foreach($affLink->affiliates as $affiliate)
                @foreach($affiliate->affiliateSales as $sale)
                    <tr>
                        <td>{{ $sale->payment_id }}</td>
                        <td><a href="{{route('voyager.users.show', ['id' => $affiliate->referred_user_id])}}">{{ $affiliate->referred_user_id }}</a></td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
              @endforeach
          @endforeach
      </tbody>
  </table>
@endsection