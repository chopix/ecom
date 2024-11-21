<div style="width: 100%;">
    <section class="content container">
        <h1 class="content__title"> Select Bundle or Individual Tools </h1>


        <h3 class="content__block-title">Package Plan</h3>

        <div class="plans">
            <div class="row">
                @foreach ($packages as $package)
                    <div class="col-md-6">
                        <div class="card">
                        <div class="plans__block">
                            <p class="plans__block-title">{{$package['title']}}</p>
                            <p class="plans__block-price"><span>{{$package['currency_symbol']}}{{$package['price']}}</span>/mo</p>
                            @php
                                $isInCart = collect(session('cart'))->contains(function ($item) use ($package) {
                                    return $item['product_id'] === $package['product_id'];
                                });
                            @endphp

                            @if ($isInCart)
                                <a href="{{route('summaryOrder')}}" class="plans__block-btn">Go to the cart</a>
                            @else
                               <form action="{{ route('cart.add') }}" method="POST" x-data="{ submitted: false }" @submit="submitted = true">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$package['product_id']}}">
                                    <input type="hidden" name="productType" value="Package">
                                    <button type="submit" class="plans__block-btn" :disabled="submitted">Add to cart</button>
                                </form>
                            @endif
                            <ul>
                                @foreach($package['tools_included'] as $tool)
                                    <li><img style="width: 40px;height: 20px;display: block;" src="{{asset($tool->image)}}" alt="{{$tool->title}} logo">{{$tool->title}}</li>
                                @endforeach
                            </ul>
                            <button  class="card-view plans__block-view modal-trigger">View All Features </button>
                        </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="content__block-title">Individual Tools</h3>

        <div class="plans">
            <div class="row">
                @foreach($tools as $tool)
                    <div class="col-md-3">
                        <div class="card">
                        <div class="plans__block">
                            <div class="plans__block-img">
                                <img src="{{asset($tool['image'])}}" alt="plan-img">
                            </div>
                            <p class="plans__block-title">{{$tool['title']}}</p>
                            <p class="plans__block-price"><span>{{$tool['currency_symbol']}}{{$tool['price']}}</span>/mo</p>
                            @php
                                $isInCart = collect(session('cart'))->contains(function ($item) use ($tool) {
                                    return $item['product_id'] === $tool['product_id'];
                                });
                            @endphp
                            
                            @if ($isInCart)
                                <a href="{{route('summaryOrder')}}" class="plans__block-btn">Go to the cart</a>
                            @else
                                <form action="{{ route('cart.add') }}" method="POST" x-data="{ submitted: false }" @submit="submitted = true">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$tool['product_id']}}">
                                    <button  type="submit" class="plans__block-btn" :disabled="submitted">Add to cart</button>
                                </form>
                            @endif
                            <button class="card-view plans__block-view modal-trigger">View All Features</button>
                        </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="wiro-modal-overlay"></div>
    @foreach ($packages as $package)
        <div class="wiro-modal">
            <h3 class="wiro-modal__title">Detailed information<span>{{$package['title']}}</span></h3>
            <h4>Advantages of this plan</h4>
            <h5 class="wiro-modal__descr">{{$package['description']}}</h5>
            <table>
                <tr>
                    <h5>Tools will be available to you</h5>
                </tr>
                @foreach ($package['tools_included'] as $tool)
                    <tr>
                        <td>{{$tool->title}}</td>
                    </tr>      
                @endforeach
            </table>
            <div class="wiro-modal__price">
                <p class="wiro-modal__title">Monthly subscription price</p>
                <p class="wiro-modal__price-value">
                    <span>{{session('user_currency')->symbol}}{{$package['price']}}</span>/mo
                </p>
            </div>
            <div class="wiro-modal__btns">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $isInCart = collect(session('cart'))->contains(function ($item) use ($package) {
                                return $item['product_id'] === $package['product_id'];
                            });
                        @endphp
                        @if ($isInCart)
                            <a href="{{route('summaryOrder')}}" class="wiro-modal__btn">Go to the cart</a>
                        @else
                            <form action="{{ route('cart.add') }}" method="POST" x-data="{ submitted: false }" @submit="submitted = true">
                                @csrf
                                <input type="hidden" name="productId" value="{{$tool['product_id']}}">
                                <button  type="submit" class="wiro-modal__btn blue" :disabled="submitted">Choose</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="wiro-modal__btn wiro-modal-close">Close</div>
                    </div>
                </div>
            </div>
            {{-- <a href="#" class="wiro-modal__link">Familiarize yourself with the rules for using the platform</a> --}}
        </div>
    @endforeach

    @foreach($tools as $tool)
        <div class="wiro-modal">
            <h3 class="wiro-modal__title">Detailed information<span>{{$tool['title']}}</span></h3>
            <h4 class="wiro-modal__subtitle">Advantages of this plan</h4>
            <h5 class="wiro-modal__descr">{{$tool['description']}}</h5>
            @if (json_decode($tool['benefits'], true))
                <table>
                    <tr>
                        <th>Benefits</th>
                    </tr >
                    @foreach (json_decode($tool['benefits'], true) as $benefit)
                        <tr>
                            <td>{{$benefit}}</td>
                        </tr>      
                    @endforeach
                </table>
            @endif
            <div class="wiro-modal__price">
                <p class="wiro-modal__price-text">Monthly subscription price</p>
                <p class="wiro-modal__price-value">
                    <span>{{session('user_currency')->symbol}}{{$tool['price']}}</span>/mo
                </p>
            </div>
            <div class="wiro-modal__btns">
                <div class="row">
                    <div class="col-md-6">
                        @php
                            $isInCart = collect(session('cart'))->contains(function ($item) use ($tool) {
                                return $item['product_id'] === $tool['product_id'];
                            });
                        @endphp
                        @if ($isInCart)
                            <a href="{{route('summaryOrder')}}" class="wiro-modal__btn">Go to the cart</a>
                        @else
                            <form action="{{ route('cart.add') }}" method="POST" x-data="{ submitted: false }" @submit="submitted = true">
                                @csrf
                                <input type="hidden" name="productId" value="{{$tool['product_id']}}">
                                <input type="hidden" name="productType" value="{{'Tool'}}">
                                <button  type="submit" class="wiro-modal__btn blue" :disabled="submitted">Choose</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="wiro-modal__btn wiro-modal-close">Close</div>
                    </div>
                </div>
            </div>
            {{-- <a href="#" class="wiro-modal__link">Familiarize yourself with the rules for using the platform</a> --}}
        </div>
    @endforeach
        
</div>
