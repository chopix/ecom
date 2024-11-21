@extends('voyager::master')

@section('page_title', 'Currencies')

@section('content')
  <h1>Currencies</h1>
  <form action="{{ route('admin.currencies.updateCurrencies') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Currency</th>
                    <th>Symbol</th>
                    <th>Country</th>
                    <th>Is Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $currency)
                    <tr>
                        <td>{{ $currency->id }}</td>
                        <td>{{ $currency->currency }}</td>
                        <td>{{ $currency->symbol }}</td>
                        <td>{{ $currency->country }}</td>
                        <td>
                            <input type="checkbox" name="active_currencies[]" value="{{ $currency->id }}" {{ $currency->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
@endsection