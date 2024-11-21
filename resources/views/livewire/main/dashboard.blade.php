<section class="content container">
            <h1 class="content__title"> Dashboard </h1>
            <h2 class="content__subtitle"> Your Current Plans and Invoices </h2>
            <h3 class="content__block-title">Package Plan</h3>

            @foreach ($packages as $package)
                @unless($package['active'])
                    @continue
                @endunless
                <div class="content__block {{$package['active'] ? 'active' : ''}}">
                    <div class="content__block-wrapper">
                        <p class="content__block-subtitle">
                            <img src="{{asset('/img/icons/elitePlan.svg')}}" alt="img">
                            {{$package['product']['title']}}
                        </p>
                        @if ($package['active'])
                            <img class="arrow" src="{{asset('/img/icons/arrow.svg')}}" alt="arrow">
                            @else
                            <img src="{{asset('/img/icons/none.svg')}}" alt="arrow">
                        @endif
                    </div>
                    @if($package['active'])
                        <div class="content__block-inforamtion">
                            <div class="content__block-info">
                                Activation plan: <br>
                                <span>{{$package['started_at']}}</span>
                            </div>
                            <div class="content__block-info">
                                To expire: <br>
                                <span>{{$package['expires_at']}}</span>
                            </div>
                            <div class="content__block-info">
                                The remaining number of days: <br>
                                <span>{{$package['remaining_days']}}</span>
                            </div>
                            <div class="content__block-info">
                                Active tools<br>
                                <span>{{count($package['product']['tools_included'])}}</span>
                            </div>
                        </div>
                    
                        <div class="content__block-plans">
                            @foreach ($package['product']['tools_included'] as $tool)
                                <div class="content__block-plan">
                                    <p class="content__block-subtitle content__block-plan-title">
                                        <img src="{{asset($tool->image)}}" alt="img">
                                        {{$tool->title}}
                                    </p>
                                    <div class="row" x-data="{ activeLink: '{{ $tool->main_link }}' }">
                                        @if ($tool->links)
                                            <div class="col-md-6">
                                                <div class="wrapper__block">
                                                    <div class="wrapper__block-input wrapper__block-select">
                                                        <label for="language{{$tool->index}}">Choose a language</label>
                                                        <select id="language{{$tool->index}}" name="country" x-on:change="activeLink = $event.target.value">
                                                            <option value="{{$tool->main_link}}">No node selected</option>
                                                            @foreach(json_decode($tool->links, true) as $lang => $link)
                                                                <option value="{{$link}}">{{$lang}}</option>                                                        
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6 d-flex flex-column justify-content-center" style="    margin-top: 15px;">
                                            <div class="content__block-plan-wrapper">
                                                @if ($tool->main_link)
                                                    <a x-bind:href="activeLink" class="content__block-plan-btn full">
                                                        <img src="{{asset('/img/icons/share1.svg')}}" alt="share">
                                                        Open link
                                                    </a>
                                                @endif
                                                @if($tool->extension)
                                                    <a href="{{route('download', ['path' => $tool->extension])}}" class="content__block-plan-btn black">
                                                        <img src="{{asset('/img/icons/share3.svg')}}" alt="share">
                                                        Install the extension
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            <a href="{{route('plans')}}" class="content__explore">Explore Plans <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                <path d="M1 6.56392H9.44646" stroke="#0066FF" stroke-linecap="round"/>
                <path d="M7.75708 3.83691L10.291 6.56419L7.75708 9.29146" stroke="#0066FF" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <h3 class="content__block-title">Individual Tools</h3>
            @foreach ($tools as $tool)
                @unless($tool['active'])
                    @continue
                @endunless
                <div class="content__block {{$tool['active'] ? 'active' : ''}}">
                    <div class="content__block-wrapper">
                        <p class="content__block-subtitle">
                            <img src={{asset($tool['product']['image'])}} alt="img">
                            {{$tool['product']['title']}}
                        </p>
                        @if ($tool['active'])
                            <img class="arrow" src="{{asset('/img/icons/arrow.svg')}}" alt="arrow">
                            @else
                            <img src="{{asset('/img/icons/none.svg')}}" alt="arrow">
                        @endif
                    </div>
                    @if($tool['active'])
                        <div class="content__block-inforamtion">
                            <div class="content__block-info">
                                Activation plan: <br>
                                <span>{{$tool['started_at']}}</span>    
                            </div>
                            <div class="content__block-info">
                                To expire: <br>
                                <span>{{$tool['expires_at']}}</span>
                            </div>
                            <div class="content__block-info">
                                The remaining number of days: <br>
                                <span>{{$tool['remaining_days']}}</span>
                            </div>
                        </div>
                        <div class="content__block-plans">
                            <div class="content__block-plan">
                                <div class="row" x-data="{ activeLink: '{{ $tool['product']['main_link'] }}' }">
                                    @if ($tool['product']['links'])
                                        <div class="col-md-6">
                                            <div class="wrapper__block">
                                                <div class="wrapper__block-input wrapper__block-select">
                                                    <label for="language{{$loop->index}}">Choose a language</label>
                                                    <select id="language{{$loop->index}}" name="country" x-on:change="activeLink = $event.target.value">
                                                        <option value="{{$tool['product']['main_link']}}">No node selected</option>
                                                        @foreach(json_decode($tool['product']['links'], true) as $lang => $link)
                                                            <option value="{{$link}}">{{$lang}}</option>                                                        
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6 d-flex flex-column justify-content-center" style="    margin-top: 15px;">
                                        <div class="content__block-plan-wrapper">
                                            @if ($tool['product']['main_link'])
                                                <a x-bind:href="activeLink" class="content__block-plan-btn full">
                                                    <img src="{{asset('/img/icons/share1.svg')}}" alt="share">
                                                    Open link
                                                </a>
                                            @endif
                                            @if($tool['product']['extension'])
                                                <a href="{{route('download', ['path' => $tool['product']['extension']])}}" class="content__block-plan-btn black">
                                                    <img src="{{asset('/img/icons/share3.svg')}}" alt="share">
                                                    Install the extension
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            <a href="{{route('plans')}}" class="content__explore">Explore Plans <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                <path d="M1 6.56392H9.44646" stroke="#0066FF" stroke-linecap="round"/>
                <path d="M7.75708 3.83691L10.291 6.56419L7.75708 9.29146" stroke="#0066FF" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <div class="invoices">
                <div class="content__block-wrapper">
                    <p class="content__block-subtitle">
                        Invoices
                    </p>
                    <img class="arrow" src="../../img/icons/arrow.svg" alt="arrow">
                </div>
                <div class="content__block-plans">
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Paid with</th>
                            <th>Amount</th>
                            <th>Product</th>
                            <th>Status</th>
                        </tr>
                        @foreach ($payments as $item)
                            <tr>
                                <td>{{date('M j, Y', strtotime($item['started_at']))}}</td>
                                <td>{{$item['payment']['method']}}</td>
                                <td>{{$item['payment']['amount']}} {{$item['payment']['currency']}}</td>
                                <td>{{$item['product']['title']}}</td>
                                <td>Paid</td>
                            </tr>
                        @endforeach 
                    </table>
                </div>
            </div>
        </section>