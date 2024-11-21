@extends('voyager::master')

@section('page_title', 'Create User')

@section('content')
  <div class="container">
      <h2>Create New User</h2>
      <form method="POST" action="{{ route('admin.users.store') }}">
          @csrf
          <div class="form-group">
        <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_business" name="is_business">
            <label class="form-check-label" for="is_business">Is Business</label>
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" class="form-control" id="full_name" name="full_name">
        </div>
        <div class="form-group">
            <label for="vat_number">VAT Number:</label>
            <input type="text" class="form-control" id="vat_number" name="vat_number">
        </div>
        <div class="form-group">
            <label for="company_name">Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="town_city">Town/City:</label>
            <input type="text" class="form-control" id="town_city" name="town_city">
        </div>
        <div class="form-group">
            <label for="state_country">State/Country:</label>
            <input type="text" class="form-control" id="state_country" name="state_country">
        </div>
        <div class="form-group">
            <label for="postcode">Postcode:</label>
            <input type="text" class="form-control" id="postcode" name="postcode">
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>


        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="send_welcome" name="send_welcome">
            <label class="form-check-label" for="send_welcome">Send "Welcome To" email</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="send_verify" name="send_verify">
            <label class="form-check-label" for="send_verify">Send verify link</label>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>

        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </form>
  </div>
@endsection