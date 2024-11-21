<form action="{{route('auth.register')}}" method="POST" x-data="{
    business: {{old('is_business') ? 'true' : 'false'}},
    currentStep: '{{session('current_step')}}',
}">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="wrapper__block">
                <div class="wrapper__block-text">
                    <p class="wrapper__block-title">Choose Your Invoicing Choise</p>
                    <p class="wrapper__block-subtitle">Select Individual Plans or Opt for Our Bundle Offers.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="wrapper__block">
                <label class="wrapper__block-switch">
                    <input id='fluency' name="is_business" type="checkbox" @click="business = !business; currentStep = '';" {{ old('is_business') ? 'checked' : '' }}>
                    <span class="wrapper__block-switch-round"></span>
                    </label>
                <div class="wrapper__block-text">
                    <p class="wrapper__block-title">Individual Invoicing</p>
                    <p class="wrapper__block-subtitle">Turn on to buy Business Invoicing</p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <input type="hidden" x-bind:value="JSON.stringify(selectedPackages)" name="selected_packages">
            <input type="hidden" x-bind:value="JSON.stringify(selectedTools)" name="selected_tools">

            <div class="row" x-show="(!business || currentStep === 'step-1') && currentStep !== 'step-2'">
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="first_name">First Name<span>*</span></label>
                            <input id="first_name" class="{{$errors->has('first_name') ? 'form-control is-invalid' : ''}}" name="first_name" placeholder="First Name" type="text" value="{{old('first_name')}}">
                            @error('first_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="last_name">Last Name<span>*</span></label>
                            <input id="last_name" class="{{$errors->has('last_name') ? 'form-control is-invalid' : ''}}" name="last_name" placeholder="Last Name" type="text" value="{{old('last_name')}}">
                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="username">Username<span>*</span></label>
                            <input id="username" class="{{$errors->has('name') ? 'form-control is-invalid' : ''}}" name="name" placeholder="Username(should be unique)" type="text" value="{{old('name')}}" >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="email">Email<span>*</span></label>
                            <input id="email" class="{{$errors->has('email') ? 'form-control is-invalid' : ''}}" name="email" placeholder="Email" type="email" value="{{old('email')}}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="phone_number">Phone Number<span>*</span></label>
                            <input id="phone_number" class="{{$errors->has('phone_number') ? 'form-control is-invalid' : ''}}" name="phone_number" placeholder="Phone Number" type="tel" value="{{old('phone_number')}}">
                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="password">Password<span>*</span></label>
                            <input id="password"  class="{{$errors->has('password') ? 'form-control is-invalid' : ''}}" name="password" class="password" placeholder="Password" type="password" autocomplete="off" value="{{session('password')}}">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                <g clip-path="url(#clip0_23_2449)">
                                <path d="M5.99981 4.12402C4.68985 4.12402 3.62402 5.18985 3.62402 6.49981C3.62402 7.80978 4.68985 8.8756 5.99981 8.8756C7.30978 8.8756 8.3756 7.80978 8.3756 6.49981C8.3756 5.18985 7.30978 4.12402 5.99981 4.12402ZM5.99981 8.0756C5.13086 8.0756 4.42403 7.36876 4.42403 6.49981C4.42403 5.63086 5.13086 4.92403 5.99981 4.92403C6.86876 4.92403 7.5756 5.63086 7.5756 6.49981C7.5756 7.36876 6.86876 8.0756 5.99981 8.0756Z" fill="#131313"></path>
                                <path d="M6 2.5625C3.46503 2.5625 1.12498 4.04161 0.0386475 6.33087C-0.012915 6.43967 -0.012915 6.56584 0.0388425 6.67443C1.12869 8.96077 3.46854 10.4379 6 10.4379C8.53146 10.4379 10.8713 8.96076 11.9612 6.67443C12.0129 6.56583 12.0129 6.43966 11.9614 6.33087C10.875 4.0416 8.53497 2.5625 6 2.5625ZM6 9.63792C3.83945 9.63792 1.83748 8.41311 0.846465 6.50197C1.83455 4.58848 3.83632 3.3625 6 3.3625C8.16368 3.3625 10.1654 4.58848 11.1535 6.50197C10.1625 8.41311 8.16055 9.63792 6 9.63792Z" fill="#131313"></path>
                                </g>
                                <defs>
                                <clipPath id="clip0_23_2449">
                                <rect width="12" height="12" fill="white" transform="translate(0 0.5)"></rect>
                                </clipPath>
                                </defs>
                            </svg> --}}
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" x-show="(business || currentStep === 'step-2') && currentStep !== 'step-1'">
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="full_name">Full Name<span>*</span></label>
                            <input id="full_name" class="{{$errors->has('full_name') ? 'form-control is-invalid' : ''}}" name="full_name" placeholder="Full Name" type="text" value="{{old('full_name')}}">
                            @error('full_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="vat_number">VAT Number<span>*</span></label>
                            <input id="vat_number" class="{{$errors->has('vat_number') ? 'form-control is-invalid' : ''}}" name="vat_number" placeholder="VAT Number" type="text" value="{{old('vat_number')}}">
                            @error('vat_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="company">Company name<span>*</span></label>
                            <input id="company" class="{{$errors->has('company_name') ? 'form-control is-invalid' : ''}}" name="company_name" placeholder="Company name" type="text" value="{{old('company_name')}}">
                            @error('company_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="address">Address<span>*</span></label>
                            <input id="address" class="{{$errors->has('address') ? 'form-control is-invalid' : ''}}" name="address" placeholder="Address" type="text" value="{{old('address')}}">
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="town_city">Town/City<span>*</span></label>
                            <input id="town_city" class="{{$errors->has('town_city') ? 'form-control is-invalid' : ''}}" name="town_city" placeholder="Town/City" type="text" value="{{old('town_city')}}">
                            @error('town_city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="state_country">State/County<span>*</span></label>
                            <input id="state_country" class="{{$errors->has('state_country') ? 'form-control is-invalid' : ''}}" name="state_country" placeholder="State/County" type="text" value="{{old('state_country')}}">
                            @error('state_country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input">
                            <label for="postcode">Postcode<span>*</span></label>
                            <input class="{{$errors->has('postcode') ? 'form-control is-invalid' : ''}}" id="postcode" name="postcode" placeholder="Postcode" type="text" value="{{old('postcode')}}">
                            @error('postcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrapper__block">
                        <div class="wrapper__block-input wrapper__block-select">
                            <label for="country">Country<span>*</span></label>
                            <select class="{{$errors->has('country') ? 'form-control is-invalid' : ''}}" id="country" name="country">
                                <option disabled selected>Country enter</option>
                                <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                            </select>
                            @error('country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="wrapper__block-drop">
                <p class="wrapper__block-title">Summary Order</p>
                <img src="{{asset('/img/icons/arrow.svg')}}" class="arrow" alt="arrow">
            </div>
            <div class="wrapper__block-content">
                <div class="row">
                    <template x-for="package in selectedPackages" :key="package.id">
                        <div class="col-md-6">
                            <div class="wrapper__block-content-title d-flex justify-content-between">
                                <p x-text="package.title"></p>
                                <p>{{session('user_currency')->symbol}}<span class="result" x-text="package.price"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="row">
                    <template x-for="tool in selectedTools" :key="tool.id">
                        <div class="col-md-6">
                            <div class="wrapper__block-content-title d-flex justify-content-between">
                                <p x-text="tool.title"></p>
                                <p>{{session('user_currency')->symbol}}<span class="result" x-text="tool.price"></span></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <div class="checkbox-block {{$errors->has('highload') ? 'checkbox-block-error' : ''}}">
        <input id="highload0"  name="highload" class="checkbox-custom" type="checkbox" {{ old('highload') ? 'checked' : '' }}>
        <label for="highload0" class="checkbox-custom-label">I have read and agree to Bundledseo's Terms and Conditions.</label>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="form-btn full">
                Next
            </button>
        </div>
    </div>
    <p class="login">
        Already have an account?
        <a href="{{route('auth.showLogin')}}">Login</a>
    </p>
</form>
