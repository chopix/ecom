<section class="content container">
    <h1 class="content__title"> Cart </h1>
    <h2 class="content__subtitle"> Items count: <span>{{count($items)}}</span></h2>

    <div class="summary">
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-4" style="margin-top: 40px;">
                    <div class="summary__block">
                        @if (array_key_exists('image', $item['product']))
                            <div class="summary__block-img">
                                <img src="{{asset($item['product']['image'])}}" alt="logo">
                            </div>
                        @endif
                        <div class="summary__block-title">
                            {{$item['product']['title']}}
                            <form action="{{route('cart.remove')}}" method="POST">
                                @csrf
                                <input type="hidden" name="productId" value="{{$item['product_id']}}">
                                <button type="submit">
                                    <img src="{{asset('img/icons/delete.svg')}}" alt="delete">
                                </button>
                            </form>
                        </div>
                        <div class="summary__block-value">
                            {{session('user_currency')->symbol}}<span class="value">{{$item['product']['price']}}</span>
                            <span class="summary__block-value-gray">/mo</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>

        <div class="row">
            <div class="col-md-4">
                <p class="summary__values total">Total item<br><br><span class="value">{{$highestPrice}}</span><span>{{session('user_currency')->symbol}}</span></p>
            </div>
            <div class="col-md-4">
                <p class="summary__values subtotal">Subtotal<br><br><span class="value">{{$totalPrice}}</span><span>{{session('user_currency')->symbol}}</span></p>
            </div>
            <div class="col-md-4">
                <p class="summary__values order-total">Order total<br><br><span class="value">{{$totalPrice}}</span><span>{{session('user_currency')->symbol}}</span></p>
            </div>
        </div>

        @if(count($items))
            <h3 style="margin-top: 40px;">Pay via</h3>
            {{-- @if(session('user_currency')->currency === 'INR') --}}
                <form action="{{route('payment.razorpay')}}" method="POST">
                    @csrf
                    <button type="submit" class="summary__btn">
                        <img src="{{asset('img/payment/Razorpay.png')}}" style="width: 110px;">
                    </button>
                </form>
            {{-- @else --}}
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="summary__btn">
                        <p style="margin: 0; color: black; font-size: 24px;">Paddle</p>
                    </button>
                </form>
            {{-- @endif --}}
        @endif
    </div>
</section>

@if (session('razorpay_order'))
    @pushOnce('scripts')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            const options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": "{{ session('razorpay_order')->amount }}",
                "currency": "{{session('razorpay_order')->currency}}",
                "name": "{{env('APP_NAME')}}",
                "order_id": "{{ session('razorpay_order')->id }}",
                "handler": function (response) {
                    axios.post("{{ route('cart.session.reload') }}", {}, {
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    }).then(resp => {
                        if(resp.data?.success) {
                           window.location.reload(true);
                        }
                    });
                },
            };

            const rzp1 = new Razorpay(options);

            rzp1.open();
        </script>
    @endPushOnce
@endif
