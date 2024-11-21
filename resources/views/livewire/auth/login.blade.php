
<div>
    <h3 class="wrapper__subtitle" >Hi, Welcome back! Enter Your Email and Password to Access Your Account.</h3>
    <form action="{{route('auth.login')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="wrapper__block">
                    <div class="wrapper__block-input {{$errors->has('login') ? 'error' : ''}}">
                        <label for="username">Username or Email<span>*</span></label>
                        <input id="username" name="login" placeholder="Username or Email" type="text" value="{{old('login')}}" autocomplete="email">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="wrapper__block">
                    <div class="wrapper__block-input {{$errors->has('login') ? 'error' : ''}}">
                        <label for="password">Password<span>*</span></label>
                        <input id="password" name="password" class="password" placeholder="Password" type="password" autocomplete="off">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                            <g clip-path="url(#clip0_23_2449)">
                            <path d="M5.99981 4.12402C4.68985 4.12402 3.62402 5.18985 3.62402 6.49981C3.62402 7.80978 4.68985 8.8756 5.99981 8.8756C7.30978 8.8756 8.3756 7.80978 8.3756 6.49981C8.3756 5.18985 7.30978 4.12402 5.99981 4.12402ZM5.99981 8.0756C5.13086 8.0756 4.42403 7.36876 4.42403 6.49981C4.42403 5.63086 5.13086 4.92403 5.99981 4.92403C6.86876 4.92403 7.5756 5.63086 7.5756 6.49981C7.5756 7.36876 6.86876 8.0756 5.99981 8.0756Z" fill="#131313"/>
                            <path d="M6 2.5625C3.46503 2.5625 1.12498 4.04161 0.0386475 6.33087C-0.012915 6.43967 -0.012915 6.56584 0.0388425 6.67443C1.12869 8.96077 3.46854 10.4379 6 10.4379C8.53146 10.4379 10.8713 8.96076 11.9612 6.67443C12.0129 6.56583 12.0129 6.43966 11.9614 6.33087C10.875 4.0416 8.53497 2.5625 6 2.5625ZM6 9.63792C3.83945 9.63792 1.83748 8.41311 0.846465 6.50197C1.83455 4.58848 3.83632 3.3625 6 3.3625C8.16368 3.3625 10.1654 4.58848 11.1535 6.50197C10.1625 8.41311 8.16055 9.63792 6 9.63792Z" fill="#131313"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_23_2449">
                            <rect width="12" height="12" fill="white" transform="translate(0 0.5)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @error('login')
            <div class="form-errors">
                {{$message}}
            </div>
        @enderror
        <a href="{{route('password.request')}}" class="wrapper__question">Forgot Password?</a>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="form-btn full">
                    Log In
                </button>
            </div>
        </div>
        <p class="login">
            Not registered yet? 
            <a href="{{route('auth.register')}}">Create an Account</a>
        </p>

        <!-- <h3 class="wrapper__subtitle" style="color: #ff7f7f;font-size: 14px;">
            Also we have upgraded to a more advanced system for enhanced security. We kindly ask all existing users to reset their passwords as part of this upgrade. Enter Your Email and Password to Access Your Account.
        </h3> -->
    </form>
</div>