@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">Log in</h1>
        <p>
            Don't have a Holly account yet?
            <a href="../users/new.html" class="hyperlink">Sign up for free</a>.
        </p>
        <form accept-charset="UTF-8" action="https://hollyapp.com/session" class="simple_form" id="new_sign_in"
              method="post">
            <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input
                    name="authenticity_token" type="hidden" value="4p9eLbBlo9RCyn5ZA316QDiAZzvU89hLFDRAiCMsmJ4="></div>
            <input id="mode" name="mode" type="hidden" value="">
            <dl class="controls">
                <dt>
                    <label for="sign_in_screen_name_or_email">Username or e-mail</label>
                </dt>
                <dd>

                    <input autofocus="autofocus" id="sign_in_screen_name_or_email" name="sign_in[screen_name_or_email]"
                           size="30" tabindex="1" type="text">
                </dd>
                <dt>
                    <label for="sign_in_password">Password</label>
                    <span class="controls__help">
(<a href="../password/new.html" class="hyperlink">Forgot?</a>)
</span>
                </dt>
                <dd>

                    <input id="sign_in_password" name="sign_in[password]" size="30" tabindex="2" type="password">
                </dd>
            </dl>
            <div class="buttons">
                <input class="large green button" name="commit" tabindex="3" type="submit" value="Log in">
            </div>
        </form>

    </div>

@endsection
