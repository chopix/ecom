@extends('voyager::master')

@section('page_title', 'Affiliates')

@section('content')
  <h1>Affiliates</h1>
  <table class="table table-bordered table-hover">
      <thead>
          <tr>
              <th>Affiliate name</th>
              <th>Number of Sales</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($affs as $affiliate)
              <tr>
                  <td>{{ $affiliate->affiliateLink->user->name }}</td>
                  <td>{{ $affiliate->affiliate_sales_count }}</td>
                  <td><a href="{{route('admin.affiliates.show', ['affiliate' => $affiliate->affiliateLink->user_id])}}">More detailed</a></td>
              </tr>
          @endforeach
      </tbody>
  </table>
@endsection