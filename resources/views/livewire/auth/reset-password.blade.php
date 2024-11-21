<div>
    <h3 class="wrapper__subtitle">Please enter your new password</h3>
    <form wire:submit.prevent="resetPassword">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper__block">
                    <div class="wrapper__block-input">
                        <label for="newpassword">Email<span>*</span></label>
                        <input id="newpassword" wire:model.lazy="email" class="password" placeholder="Email" type="email" required>
                        @error('email')<div class="form-errors">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="wrapper__block">
                    <div class="wrapper__block-input">
                        <label for="newpassword">New Password<span>*</span></label>
                        <input id="newpassword" wire:model.lazy="password" class="password" placeholder="New Password" type="password">
                        @error('password')<div class="form-errors">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="wrapper__block">
                    <div class="wrapper__block-input">
                        <label for="password_confirmation">Confirm New Password<span>*</span></label>
                        <input id="password_confirmation" wire:model.lazy="password_confirmation" class="password" placeholder="Confirm New Password" type="password">
                        @error('password_confirmation')<div class="form-errors">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="form-btn full">Reset Password</button>
            </div>
        </div>
        <p class="login">
            Already have an account? 
            <a href="{{ route('auth.login') }}">Login</a>
        </p>
    </form>
</div>