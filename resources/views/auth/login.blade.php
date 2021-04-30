@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">Log in</h1>
        <p>
            Don't have a Holly account yet?
            <a href="{{route('register')}}" class="hyperlink">Sign up for free</a>.
        </p>
        <form form action="{{ route('login') }}" class="simple_form" id="new_sign_in" method="post">
            @csrf
            <dl class="controls">
                <dt>
                    <label for="sign_in_screen_name_or_email">E-mail</label>
                </dt>

                @error('email')
                <span class="error_message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <dd>
                    <input autofocus="autofocus" required id="sign_in_screen_name_or_email" name="email" type="text" size="30" tabindex="2" @error('email') is-invalid @enderror">
                </dd>
                <dt>
                    <label for="sign_in_password">Password</label>
                    <span class="controls__help">
                    (<a href="{{ route('password.request') }}" class="hyperlink">Forgot?</a>)
                    </span>
                </dt>

                @error('password')
                <span class="error_message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <dd>
                    <input id="sign_in_password" name="password" required size="30" tabindex="2" type="password" @error('password') is-invalid @enderror">
                </dd>
            </dl>
            <div class="buttons">
                <input class="large green button" name="commit" tabindex="3" type="submit" value="Log in">
            </div>
        </form>

    </div>

@endsection
