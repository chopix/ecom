@extends('voyager::master')

@section('page_title', 'Give the product to the user')

@section('content')
    <h1>User Products</h1>

      <a href="{{route('admin.users.products', $id)}}" class="btn btn-primary">All the user's products</a>

      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Title</th>
                  <th>Is available</th>
                  <th>Expires at</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($allProducts as $product)
              <tr>
                  <td>{{ $product->productable->title?? '' }}</td>
                  <td>{{ $product->is_available ? 'Yes' : 'No' }}</td>
                  <td>{{ $product->expires_at ?? 'No'  }}</td>
                  <td>
                    @if ($product->is_available)
                      <form action="{{route('admin.users.products.manage.remove', $id)}}" method="POST">
                        @csrf
                        <button class="btn btn-danger" name="product_id" value="{{$product->id}}">Remove</button>
                      </form>
                    @else
                      <form action="{{route('admin.users.products.manage.add', $id)}}" method="POST">
                        @csrf
                        <input type="date" name="datetime"> 
                        <button class="btn btn-primary" name="product_id" value="{{$product->id}}">Give</button>
                      </form>
                    @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </form>
@endsection