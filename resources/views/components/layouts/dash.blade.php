<x-layouts.app :title="$title">
    <main class="dashboard">
        <div class="burger">
            <img src="{{asset('/img/icons/burger.svg')}}" alt="burger">
        </div>
        <div class="sidenav">
            <div class="sidenav__close">
                <img src="{{asset('/img/icons/cross.svg')}}" alt=cross"">
            </div>
            <div class="sidenav__menu">
                <div class="sidenav__menu-logo">
                    <img src="{{asset('img/icons/groupbuyseo.svg')}}" alt="logo">
                </div>
                <a href="{{route('dashboard')}}">
                    <img src="{{asset('img/icons/dashboard.svg')}}" alt="icon">
                    Dashboard
                </a>
                <a href="{{route('plans')}}">
                    <img src="{{asset('img/icons/plans.svg')}}" alt="icon">
                    Plans
                </a>
                <a href="{{route('summaryOrder')}}">
                    <img src="{{asset('img/icons/order.svg')}}" alt="icon">
                    Cart
                    @if(session('cart') && count(session('cart')))
                        <span class="cart-count badge rounded-circle bg-danger">{{count(session('cart'))}}</span>
                    @endif
                </a>
                <a href="{{route('support')}}">
                    <img src="{{asset('img/icons/support.svg')}}" alt="icon">
                    Support
                    @if(session('unreaded_tickets')) 
                        <span class="cart-count badge rounded-circle bg-danger">{{session('unreaded_tickets')}}</span>
                    @endif
                </a>
                <a href="https://bundledseo.com/blog/" target="_blank">
                    <img src="{{asset('img/icons/blog.svg')}}" alt="icon">
                    Blog
                </a>
                <a href="{{route('affiliate')}}">
                    <img src="{{asset('img/icons/blog.svg')}}" alt="icon">
                    Affiliate
                </a>
            </div>
    
            <div class="sidenav__contacts">
                <p class="sidenav__contacts-title">
                    Email communication
                </p>
                <p class="sidenav__contacts-subtitle">
                    <a style="text-decoration: none; color: inherit;" href="mailto:{{setting('site.company_email')}}">{{setting('site.company_email')}}</a>
                </p>
                <div class="sidenav__contacts-links">
                    @if (setting('site.facebook_link'))
                        <a href="{{setting('site.facebook_link')}}"><img src="{{asset('img/icons/contacts1.svg')}}" alt="contacts img"></a>
                    @endif
                    @if (setting('site.instagram_link'))
                        <a href="{{setting('site.instagram_link')}}"><img src="{{asset('img/icons/contacts2.svg')}}" alt="contacts img"></a>
                    @endif
                    @if (setting('site.twitter_link'))
                        <a href="{{setting('site.twitter_link')}}"><img src="{{asset('img/icons/contacts3.svg')}}" alt="contacts img"></a>
                    @endif
                </div>
            </div>
    
            <div class="sidenav__settings">
                <p class="sidenav__settings-email">
                    <img src="{{asset('/img/icons/avatar.svg')}}" alt="avatar">
                    {{auth()->user()->email}}
                </p>
                <a href="{{route('user.profile')}}" class="sidenav__settings-btn">Account settings</a>
                <form action="{{route('auth.logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="sidenav__settings-logout">
                        <img src="{{asset('img/icons/logout.svg')}}" alt="logout">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
        <div class="flex w-100">
            {{$slot}}
        </div>
    </main>
</x-layouts.app>