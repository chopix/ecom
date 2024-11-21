@extends('voyager::master')

@section('page_title', 'User Products')

@section('content')
    <h1>User Products</h1>

    <form action="{{route('admin.users.products.update', $id)}}" method="POST">
      @csrf
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{route('admin.users.products.manage', $id)}}" class="btn btn-primary">Manage user's products</a>

      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Title</th>
                  <th>Started at</th>
                  <th>Expires at</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($products as $product)
              <tr>
                  <td>{{ $product->product->productable->title }}</td>
                  <td>{{ $product->started_at }}</td>
                  <td>{{ $product->expires_at }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </form>
@endsection