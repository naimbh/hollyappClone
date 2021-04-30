<!DOCTYPE html>
<html>
<head>
    <meta content='text/html; charset=utf-8' http-equiv='content-type'>
    <title>
        Task tracking for nerds - HOLLY SHELL
    </title>
    <script src="{{asset('assets')}}/classic/main.min.js" type="text/javascript"></script>

    <link href="{{asset('assets')}}/desktop/all-2aa9f9ef63b18438d94899689b4a59af.css" media="screen, print"
          rel="stylesheet"
          type="text/css"/>
    <meta content="{{ csrf_token() }}" name="csrf-token"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1' name='viewport'>
    <!-- Some of these icons cc-licensed from the Farm-fresh icon set by FatCow Web Hosting (http://www.fatcow.com/free-icons) -->
    <link href='{{asset('assets')}}/icons/holly.256-7ef726802d22480062a8e8df38f47ebd.png' rel='shortcut icon'
          sizes='256x256'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.196-55d04745b323ef5b180de0d7a4144f2f.png' rel='shortcut icon'
          sizes='196x196'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.128-222ba385c3aa6bf8279ff096d88d0147.png' rel='shortcut icon'
          sizes='128x128'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.64-cad3f4f29ae165dfcf4562ae7acb0a90.png' rel='shortcut icon'
          sizes='64x64'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.32-db49c97275533ebd9ab280a14f376f97.png' rel='shortcut icon'
          sizes='32x32'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.16-7c7916f61ab0d6fd93a27ca9749532c7.png' rel='shortcut icon'
          sizes='16x16'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.256-7ef726802d22480062a8e8df38f47ebd.png' rel='apple-touch-icon'
          sizes='256x256'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.196-55d04745b323ef5b180de0d7a4144f2f.png' rel='apple-touch-icon'
          sizes='196x196'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.128-222ba385c3aa6bf8279ff096d88d0147.png' rel='apple-touch-icon'
          sizes='128x128'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.64-cad3f4f29ae165dfcf4562ae7acb0a90.png' rel='apple-touch-icon'
          sizes='64x64'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.32-db49c97275533ebd9ab280a14f376f97.png' rel='apple-touch-icon'
          sizes='32x32'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.16-7c7916f61ab0d6fd93a27ca9749532c7.png' rel='apple-touch-icon'
          sizes='16x16'
          type='image/png'>
    <link href='{{asset('assets')}}/icons/holly.startup.320-571fe72757b32cfbde13564d4569eade.png'
          rel='apple-touch-startup-image'>
    <meta content='black' name='apple-mobile-web-app-status-bar-style'>
    <meta content='yes' name='apple-mobile-web-app-capable'>
    <meta content='yes' name='mobile-web-app-capable'>
    <link rel="stylesheet" href="{{asset('assets')}}/custom.css">


</head>
<body class="home production" data-current_mode="desktop" data-rendered_mode="desktop">

<div class="main_navigation single_line" data-current="null">
    <div class="main_navigation_sections">
        <div class='primary'>
            <a class='current mode' href='{{route('home')}}' target='_self'><span class='mode__holly'>HOLLY</span>
                <span class='mode__subproduct'>SHELL</span></a>
            {{--            <a class='mode' href='touch.html' target='_self'><span class='mode__holly'>HOLLY</span>--}}
            {{--                <span class='mode__subproduct'>TOUCH</span></a>--}}
        </div>
        <div class='secondary'>
            <a class='section {{request()->routeIs("note.index")? "current" : ""}}' data-hotkey='t' href='{{route('note.index')}}'>
                <span class='text'>Trees</span>
                <span class='bubble'>

                    @if (auth()->check())
                        {{\App\Note::where('user_id', auth()->user()->id)->count()}}
                    @elseif (session()->has('note.ids'))
                        {{\App\Note::find(session('note.ids'))->count()}}
                    @else
                        0
                    @endif

                </span>
            </a>

            @if(auth()->check())
                <div class='section {{request()->routeIs("dashboard")? "current" : ""}}'>
                    <a class='text' href='{{route('dashboard')}}' target='_self'>
                        Account
                    </a>
                </div>
                <div class='section'>
                    <a class='text' onclick="event.preventDefault(); document.getElementById('logout').submit();"
                       href='{{route('logout')}}' target='_self'>
                        Logout
                    </a>
                    <form id="logout" action="{{route('logout')}}" method="post" style="display: none;">
                        @csrf
                    </form>
                </div>
            @else
                <div class='section {{request()->routeIs("login")? "current" : ""}}'>
                    <a class='text' href='{{route('login')}}'>
                        Log in
                    </a>
                </div>
                <div class='section {{request()->routeIs("register")? "current" : ""}}'>
                    <a class='text' href='{{route('register')}}' target='_self'>
                        Join
                    </a>
                </div>
            @endif

        </div>
        <div class="main_navigation_expander"><span class="icon-reorder icon"><span class="label">Menu</span></span>
        </div>
    </div>
</div>

{{-- Contents --}}
@yield('content')


{{--footer--}}
<div class='tail'>
    <div class='tail__links'>
        <a href="https://twitter.com/hollyapp" class="tail__social_profile_link is_twitter"><span
                class="icon-twitter icon"></span></a>
        <a href="https://plus.google.com/u/0/b/110898195283640217990/110898195283640217990"
           class="tail__social_profile_link is_google_plus"><span class="icon-google-plus icon"></span></a>
        <a href="https://www.facebook.com/hollyapp" class="tail__social_profile_link is_facebook"><span
                class="icon-facebook icon"></span></a>
        <a class="tail__fine_print_link" href="mailto:contact@hollyapp.com">Contact</a>
        <a href="{{route('plans')}}" class="tail__fine_print_link">Pricing</a>
        <a href="{{route('imprint')}}" class="tail__fine_print_link">Imprint</a>
        <a href="{{route('terms')}}" class="tail__fine_print_link">Terms</a>
        <a href="{{route('privacy')}}" class="tail__fine_print_link">Privacy</a>
    </div>
</div>

<!-- Scripts -->
@stack('js')

</body>
</html>
