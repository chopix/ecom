
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="wrapper__block">
                <div class="wrapper__block-text">
                    <p class="wrapper__block-title">Choose Your Plan or Individual Tools</p>
                    <p class="wrapper__block-subtitle">Select Individual Plans or Opt for Our Bundle Offers.</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="wrapper__block-drop">
                <p class="wrapper__block-title">Package Plan</p>
                <img src="../../img/icons/arrow.svg" class="arrow" alt="arrow">
            </div>
            <div class="wrapper__block-content package plan-content">
                <div class="col-md-12">
                    @for ($i = 0; $i < count($packages); $i++)
                        <div class="wrapper__block-plan modal-trigger"
                            :class="selectedPackages[{{$packages[$i]['id']}}] ? 'selected' : ''"
                        >
                            <div class="wrapper__block-plan-title">
                                <h3>{{$packages[$i]['title']}}</h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <circle cx="10" cy="10.5" r="6.75" stroke="#BBC0C8" stroke-width="1.5"/>
                                    <circle cx="10" cy="7.0625" r="0.625" fill="#BBC0C8"/>
                                    <rect x="9.375" y="8.44043" width="1.25" height="6.1875" rx="0.625" fill="#BBC0C8"/>
                                </svg>
                            </div>
                            <p class="wrapper__block-plan-subtitle">Bundledseo’s {{$packages[$i]['title']}}</p>
                            <p class="wrapper__block-plan-price"><span>{{session('user_currency')->symbol}}{{$packages[$i]['price']}}</span>/mo</p>
                            <div class="wrapper__block-plan-images">
                                @foreach ($packages[$i]['tools_included'] as $tool)
                                    <div style="width: 44px; height: 44px; border-radius: 50%;">
                                        <img src="{{asset($tool->image)}}" style="width: 100%;" alt="img">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if($i % 2 == 1)
                            </div>
                            <div class="col-md-12">
                        @endif
                    @endfor
                </div>
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="wrapper__block-drop">
                <p class="wrapper__block-title">Individual Tools</p>
                <img src="{{asset('/img/icons/arrow.svg')}}" class="arrow" alt="arrow">
            </div>
            <div class="wrapper__block-content plan-content individual-content">
                <div class="col-md-12">
                    @for ($i = 0; $i < count($tools); $i++)
                        <div class="wrapper__block-plan modal-trigger"   
                            :class="selectedTools[{{$tools[$i]['id']}}] ? 'selected' : ''"
                            @click="selectTool({ 
                                id: {{ $tools[$i]['id'] }}, 
                                title: '{{ $tools[$i]['title'] }}',
                                price: '{{ $tools[$i]['price'] }}'
                            })">
                            <div class="wrapper__block-plan-title" >
                                <img src="{{$tools[$i]['image']}}" alt="img"  height="35" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <circle cx="10" cy="10.5" r="6.75" stroke="#BBC0C8" stroke-width="1.5"/>
                                    <circle cx="10" cy="7.0625" r="0.625" fill="#BBC0C8"/>
                                    <rect x="9.375" y="8.44043" width="1.25" height="6.1875" rx="0.625" fill="#BBC0C8"/>
                                </svg>
                            </div>
                            <p class="wrapper__block-plan-subtitle">{{$tools[$i]['title']}}</p>
                            <p class="wrapper__block-plan-price"><span>{{session('user_currency')->symbol}}{{$tools[$i]['price']}}</span>/mo</p>
                        </div>
                        @if($i % 2 == 1)
                            </div>
                            <div class="col-md-12">
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button @click="window.history.pushState({}, '', '?step-two'); showStepOne = false; showStepTwo = true" type="button" class="form-btn full">
                Continue Purchase
                
            </button>
        </div>
    </div>
    <p class="login">
        Already have an account?
        <a href="{{route('auth.showLogin')}}">Login</a>
    </p>
</form>
    
    <div class="wiro-modal-overlay"></div>
    @foreach ($packages as $package)
        <div class="wiro-modal">
            <h3 class="wiro-modal__title">Detailed information<span>{{$package['title']}}</span></h3>
            <h4 class="wiro-modal__subtitle">Advantages of this plan</h4>
            <h5 class="wiro-modal__descr">{{$package['description']}}</h5>
            <table>
                <tr>
                    <th>Tools will be available to you</th>
                </tr>
                @foreach ($package['tools_included'] as $tool)
                    <tr>
                        <td>{{$tool->title}}</td>
                    </tr>      
                @endforeach
            </table>
            <div class="wiro-modal__price">
                <p class="wiro-modal__price-text">Monthly subscription price</p>
                <p class="wiro-modal__price-value">
                    <span>{{session('user_currency')->symbol}}{{$package['price']}}</span>/mo
                </p>
            </div>
            <div class="wiro-modal__btns">
                <div class="row wiro-modal-close">
                    <div class="col-md-6">
                        <button x-show="selectedPackages[{{$package['id']}}]" class="wiro-modal__btn" @click="selectPackage({id: {{$package['id']}}, title: '{{$package['title']}}', price: {{$package['price']}}});">
                            Cancel the select
                        </button>
                        <div x-show="!selectedPackages[{{$package['id']}}]" class="wiro-modal__btn blue"  @click="selectPackage({id: {{$package['id']}}, title: '{{$package['title']}}', price: {{$package['price']}}});">Choose</div>
                    </div>
                    <div class="col-md-6">
                        <div class="wiro-modal__btn">Close</div>
                    </div>
                </div>
            </div>
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
                    </tr>
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
                <div class="row wiro-modal-close">
                    <div class="col-md-6" x-data="{ selectedTools: { {{$tool['id']}}: false } }">
                        <button x-show="selectedTools[{{$tool['id']}}]" class="wiro-modal__btn" @click="selectTool({id: {{$tool['id']}}, title: '{{$tool['title']}}', price: {{$tool['price']}}});">
                            Cancel the select
                        </button>
                        <div x-show="!selectedTools[{{$tool['id']}}]" class="wiro-modal__btn blue" @click="selectTool({id: {{$tool['id']}}, title: '{{$tool['title']}}', price: {{$tool['price']}}});">Choose</div>
                    </div>
                    <div class="col-md-6">
                        <div class="wiro-modal__btn">Close</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach