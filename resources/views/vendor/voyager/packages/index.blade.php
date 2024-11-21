
@extends('voyager::master')

@section('page_title', 'Packages')

@section('content')
<h1>Packages</h1>

<!-- Add New Button -->
<a href="{{ route('admin.packages.create') }}" class="btn btn-success">
    Add New
</a>

<!-- Display Existing Tools -->
@if ($packages->isNotEmpty())
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Tools Included</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($packages as $package)
        <tr>
            <td>{{ $package->title }}</td>
            <td>{{ $package->description }}</td>
            <td>{{ $package->price }}</td>
            <td>
                @forelse ($package->tools_included as $include)
                <div class="d-flex border-0">
                    <div>
                        <img src="{{ asset($include->image ?? 'path/to/default/image.png') }}" alt="{{ $include->title }}" height="30px" >
                    </div>
                    <div>
                        {{ $include->title }}
                    </div>
                </div>
                @empty
                <p>No tools included.</p>
                @endforelse
            </td>
            <td>
                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert alert-warning text-center">Nothing found</div>
@endif
@endsection