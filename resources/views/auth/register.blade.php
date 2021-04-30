@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">Join Holly
        </h1>
        <p>
            By registering a free account your trees will always be synchronized between your devices.
        </p>
        <form accept-charset="UTF-8" action="{{route('register')}}" class="simple_form" id="new_user" method="post">
            @csrf
            <dl class="controls">
                <dt>
                    <label for="user_screen_name">Username</label>
                    <span class=" required_field" title="required">*</span>
                </dt>

                @error('name')
                <span class="error_message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <dd>
                    <input autofocus="autofocus" value="{{old('name')}}" id="user_screen_name" name="name" size="30"
                           spellcheck="false" type="text">
                </dd>
                <dt>
                    <label for="user_email">E-mail</label>
                    <span class=" required_field" title="required">*</span>
                </dt>

                @error('email')
                <span class="error_message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <dd>
                    <input id="user_email" value="{{old('email')}}" name="email" required size="30" spellcheck="false" type="text">
                </dd>

                <dt>
                    <label for="user_password">Password</label>
                    <span class=" required_field" title="required">*</span>
                </dt>
                @error('password')
                <span class="error_message" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <dd>
                    <input id="user_password" name="password" required size="30" type="password">
                </dd>

                <dt>
                    <label for="user_password2">Confirm Password</label>
                    <span class=" required_field" title="required">*</span>
                </dt>
                <dd>
                    <input id="user_password2" name="password_confirmation" required size="30" type="password">
                </dd>

                <dd class="check_box">
                    <input name="user[fine_print_accepted]" type="hidden" value="0"><input id="user_fine_print_accepted" name="user[fine_print_accepted]" type="checkbox" value="1" required>
                    <label class="fine_print_accepted" for="user_fine_print_accepted">I accept the <a
                            href="{{route('terms')}}" class="hyperlink rmodal_opener" target="_blank">terms of service</a> and <a href="{{route('privacy')}}" class="hyperlink rmodal_opener">privacy policy</a></label>
                </dd>
            </dl>
            <div class="buttons">
                <button class="large blue button" id="submit" name="button" type="submit">Join
                </button>
            </div>
        </form>

    </div>

@endsection







{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
