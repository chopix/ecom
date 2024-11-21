<section class="content container">
    <h1 class="content__title">My Plans </h1>
    {{-- <h2 class="content__subtitle"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. </h2> --}}


    <div class="products invoices">
        <div class="content__block-plans">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Billing terms</th>
                </tr>
                @foreach ($plans as $plan)
                    <tr>
                        <td>{{$plan->id}}</td>
                        <td>{{$plan->product->productable->title}}</td>
                        <td><span>{{session('user_currency')->symbol}}</span>{{$plan->product->productable->price}}/mo</td> 
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>