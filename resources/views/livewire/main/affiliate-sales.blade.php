<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Payout Date</th>
            <th scope="col">Payout Method</th>
            <th scope="col">Amount</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sales as $sale)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$sale->payment->created_at}}</td>
                <td>{{$sale->payment->method}}</td>
                <td>{{$sale->payment->amount}} {{$sale->payment->currency}}</td>
            </tr>
        @empty
            <tr>
                <td>Not found</td>
                <td>Not found</td>
                <td>Not found</td>
                <td>Not found</td>
            </tr>
        @endforelse
    </tbody>
</table>