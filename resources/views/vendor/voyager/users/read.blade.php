@extends('voyager::master')

@section('page_title', 'User')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
      User: {{$user->name}}
    </h1>

    <a href="{{route('voyager.users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
@stop

@section('content')
   @if($user)
      <div class="card" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Name: {{ $user->name }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Email: {{ $user->email }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Email verified at: {{ $user->email_verified_at ?? 'no'  }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">First name: {{ $user->first_name }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Last name: {{ $user->last_name }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Last login at: {{ $user->last_login_at }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Phone number: {{ $user->phone_number }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Is business: {{$user->is_business ? 'Yes' : 'No'}}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Full name: {{ $user->full_name }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Company name: {{ $user->company_name }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">VAT number: {{ $user->vat_number }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Address: {{ $user->address }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Town/City: {{ $user->town_city }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">State/Country: {{ $user->state_country }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Postcode: {{ $user->postcode }}</h5>
          </div>
      </div>
      <div class="card mb-4" style="margin-bottom: 10px;">
          <div class="card-body">
              <h5 class="card-title">Country: {{ $user->country }}</h5>
          </div>
      </div>
    @else
        <div class="alert alert-warning">
            Пользователь не найден.
        </div>
    @endif
@endsection