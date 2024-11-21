<div>
    @if($submitted)
        <h3 class="wrapper__subtitle">The email has been sent.</h3>
        <h3 class="wrapper__subtitle">You can send a password reset link once every 5 minutes.</h3>
    @else
        <h3 class="wrapper__subtitle">Please enter your email address, we will send a link to reset your password</h3>
        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="username">Username or Email<span>*</span></label>
                            <input id="username" wire:model="input" placeholder="Username or Email" type="text">
                            @error('input')<span class="form-errors">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="form-btn full">
                        Send link
                    </button>
                </div>
            </div>
            <p class="login">
                Already have an account? 
                <a href="{{route('auth.login')}}">Login</a>
            </p>
        </form>
    @endif
</div>