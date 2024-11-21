@extends('voyager::master')

@section('page_title', 'Payments')

@section('content')
  <div class="dimmer">
      <div class="dimmer-content">
          <h3>Latest payments</h3>
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Amount</th>
                      <th>User</th>
                      <th>Products</th>
                      <th>Transaction Time</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($payments as $payment)
                      <tr>
                          <td>{{ $payment->id }}</td>
                          <td>{{ $payment->amount }} {{$payment->currency}}</td>
                          <td><a href="{{route('voyager.users.show', ['id' => $payment->user->id])}}">{{$payment->user->name}}</a></td>
                          <td>
                            <ul class="list-group">
                                @foreach ($payment->products as $product)
                                    <li>{{$product->productable->title}}</li>
                                @endforeach
                            </ul>
                          </td>
                          <td>{{ $payment->created_at }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
@endsection