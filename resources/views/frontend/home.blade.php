@extends('frontend.layout')

@section('content')

    <div class='screen'>
        <div class='hero'>
            <h1 class="page_title is_big">Task tracking for nerds</h1>
            <p>
                <span class="product_reference ">HOLLY <span class="subproduct shell">SHELL</span></span> is a <em
                    class="neon">task tracker</em> and <em>outliner</em>
                for <em class="neon">tech-savvy</em> teams and individuals.
                If you aren't into code and text editors this will make you cry.
            </p>
            <div class='tools'>
                <a href="{{route('privacy')}}" class="button multiline red big" data-hotkey="w"
                   id="write_button" rel="nofollow">

                    @if (auth()->check() || session()->has('note.ids'))
                        Continue writing <small>We saved your stuff</small>
                    @else
                        Start writing <small>No registration required</small>
                    @endif

                </a>
                <div class='keyboard_shortcut'>
                    <span class="icon-keyboard icon"><span class="label">W</span></span>
                    <div class='explanation'>
                        Keyboard shortcut
                    </div>
                </div>
            </div>
        </div>
        <div class='devices'>
            <div class='laptop'>
                <div class='laptop__screen'>
                    <div class='laptop__webcam'></div>
                    <div class='laptop__image'></div>
                </div>
                <div class='laptop__keyboard'>
                    <div class='laptop__opener'></div>
                </div>
            </div>
            <div class="phone is_for_home_page">
                <div class="phone__frame">
                    <div class="phone__image"></div>
                    <div class="phone__home_button"></div>
                    <div class="phone__speaker"></div>
                </div>
            </div>
        </div>
        <div class='press'>
            <div class='press__known_from'>
                Known from
            </div>
            <img alt="Lifehacker - PCWorld - AppStorm" class="press__logos"
                 src="assets/home/press/collage-2964ae46f50ccd8e151c08b890dc2569.png"/>
        </div>
        <div class='columns'>
            <div class='columns__column'>
                <div class='tentpole'>
                    <div class='tentpole__image is_text'></div>
                    <div class='tentpole__info'>
                        <div class='tentpole__name'>
                            Everything is text
                        </div>
                        <div class='tentpole__description'>
                            Edit your tasks with the world's best input device: A text editor.
                            Use simple syntax for due dates, #tags or preconditions.
                        </div>
                    </div>
                </div>
                <div class='tentpole'>
                    <div class='tentpole__image is_tree'></div>
                    <div class='tentpole__info'>
                        <div class='tentpole__name'>
                            Full outliner support
                        </div>
                        <div class='tentpole__description'>
                            Every task can have sub-tasks. Nest your trees as deeply as you want.
                            Prioritize with drag'n'drop or keyboard shortcuts.
                        </div>
                    </div>
                </div>
            </div>
            <div class='columns__column'>
                <div class='tentpole'>
                    <div class='tentpole__image is_shortcuts'></div>
                    <div class='tentpole__info'>
                        <div class='tentpole__name'>
                            100% keyboard-controllable
                        </div>
                        <div class='tentpole__description'>
                            Edit your tasks without ever leaving your keyboard. Mouse optional.
                        </div>
                    </div>
                </div>
                <div class='tentpole'>
                    <div class='tentpole__image is_sync'></div>
                    <div class='tentpole__info'>
                        <div class='tentpole__name'>
                            Awesome for teams
                        </div>
                        <div class='tentpole__description'>
                            Share task lists with your colleagues and family.
                            See their changes in realtime as they happen.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
