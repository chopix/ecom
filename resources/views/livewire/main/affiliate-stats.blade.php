<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Month</th>
            <th scope="col">All clicks</th>
            <th scope="col">Unique clicks</th>
            <th scope="col">Sales</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($stats as $stat)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$stat->month_year}}</td>
                <td>{{$stat->total_clicks_count}}</td>
                <td>{{$stat->unique_clicks_count}}</td>
                <td>{{$stat->sales_count}}</td>
            </tr>    
        @empty
            <tr>
                <td>Not found</td>
                <td>Not found</td>
                <td>Not found</td>
                <td>Not found</td>
                <td>Not found</td>
            </tr>
        @endforelse
    </tbody>
</table>