@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @if ($dataTypeContent->is_blocked)
            <form action="{{route('admin.users.update.unblock', ['id' => $dataTypeContent->id])}}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-primary">Unblock this user</button>
            </form>
        @else
            <form action="{{route('admin.users.update.block', ['id' => $dataTypeContent->id])}}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-danger">Block this user</button>
            </form>
        @endif
            
        <a href="{{route('admin.users.products.update', $dataTypeContent->id)}}" class="btn btn-primary">User's products</a>

        <form class="form-edit-add" role="form"
                action="{{route('admin.users.update', ['id' => $dataTypeContent->id])}}"
                method="POST" enctype="multipart/form-data" autocomplete="off">
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('voyager::generic.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('voyager::generic.name') }}"
                                       value="{{ old('name', $dataTypeContent->name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('voyager::generic.email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('voyager::generic.email') }}"
                                       value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('voyager::generic.password') }}</label>
                                @if(isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name"
                                       value="{{ old('name', $dataTypeContent->first_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name"
                                       value="{{ old('name', $dataTypeContent->last_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone number"
                                       value="{{ old('name', $dataTypeContent->phone_number ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="is_business">Is business</label>
                                <div class="input-group-text">
                                    <input type="checkbox" type="checkbox" name="is_business" @checked($dataTypeContent->is_business)>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company number"
                                       value="{{ old('name', $dataTypeContent->company_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="vat_number">Vat number</label>
                                <input type="text" class="form-control" id="vat_number" name="vat_number" placeholder="Vat number"
                                       value="{{ old('name', $dataTypeContent->vat_number ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                                       value="{{ old('name', $dataTypeContent->address ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="town_city">Town/City</label>
                                <input type="text" class="form-control" id="town_city" name="town_city" placeholder="town/city"
                                       value="{{ old('name', $dataTypeContent->town_city ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="state_country">State/Country</label>
                                <input type="text" class="form-control" id="state_country" name="state_country" placeholder="state/country"
                                       value="{{ old('name', $dataTypeContent->state_country ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="postcode">Postcode</label>
                                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="postcode"
                                       value="{{ old('name', $dataTypeContent->postcode ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Country"
                                       value="{{ old('name', $dataTypeContent->country ?? '') }}">
                            </div>

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                        $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                    @php
                                        $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if(isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
            <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
