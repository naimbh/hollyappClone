@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">Join Holly
        </h1>
        <p>
            By registering a free account your trees will always be synchronized between your devices.
        </p>
        <form accept-charset="UTF-8" action="https://hollyapp.com/users" class="simple_form" id="new_user"
              method="post">
            <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input
                    name="authenticity_token" type="hidden" value="4p9eLbBlo9RCyn5ZA316QDiAZzvU89hLFDRAiCMsmJ4="></div>
            <input id="user_intent" name="user[intent]" type="hidden" value="sign_up">
            <dl class="controls">
                <dt>
                    <label for="user_screen_name">Username</label>
                    <span class=" required_field" title="required">*</span>
                </dt>
                <dd>

                    <input autofocus="autofocus" id="user_screen_name" name="user[screen_name]" size="30"
                           spellcheck="false" type="text">
                </dd>
                <dt>
                    <label for="user_email">E-mail</label>
                    <span class=" required_field" title="required">*</span>
                </dt>
                <dd>

                    <input id="user_email" name="user[email]" size="30" spellcheck="false" type="text">
                </dd>
                <dt>
                    <label for="user_password">Password</label>
                    <span class=" required_field" title="required">*</span>
                </dt>
                <dd>

                    <input id="user_password" name="user[password]" size="30" type="password">
                </dd>
                <dd class="check_box">

                    <input name="user[fine_print_accepted]" type="hidden" value="0"><input id="user_fine_print_accepted"
                                                                                           name="user[fine_print_accepted]"
                                                                                           type="checkbox" value="1">
                    <label class="fine_print_accepted" for="user_fine_print_accepted">I accept the <a
                            href="../terms.html" class="hyperlink rmodal_opener" target="_blank">terms of service</a>
                        and <a href="../privacy_policye7bd.html?no_accept=1" class="hyperlink rmodal_opener">privacy
                            policy</a></label>
                </dd>
            </dl>
            <div class="buttons">
                <button class="large blue button" id="submit" name="button" type="submit">Join
                </button>
            </div>
        </form>

    </div>

@endsection
