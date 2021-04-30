@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">
            <span class="text">Trees on this device</span>
            <span class="bubble">{{$notes->count()}}</span>
        </h1>

        <div class="tools single_line">
            <span class="outlying_key">
            <span class="icon-keyboard icon"><span class="label">N</span></span>
            </span>

            <div data-hotkey="n" onclick="myFunction()" class="button orange new_tree">New tree</div>

            <form id="store-form" action="{{ route('note.store') }}" method="POST" style="display: none;">
                @csrf
                <input id="name" type="text" name="name">
            </form>

        </div>
        <table class="menu_table">
            <tbody>

            @foreach($notes as $item)
                <tr>
                    <td class="menu_table__main">
                        <div class="menu_table__key">
                        <span class="outlying_key">
                        <span class="icon-keyboard icon"><span
                                class="label">{{range('A', 'Z')[$loop->iteration-1]}}</span></span>
                        </span>
                        </div>

                        <a class="button dark_blue" data-hotkey="{{range('A', 'Z')[$loop->iteration-1]}}"
                           href="{{route('note.create', $item->slug)}}">
                            <span class="text">{{$item->name}}</span>
                            <span class="bubble">
                                    {{$item->texts == null ? 0 : substr_count($item->texts, "\n")+1}}
                            </span>
                        </a>

                    </td>
                    <td class="menu_table__info">{{$item->created_at->diffForHumans()}}</td>
                    <td class="menu_table__actions">
                        <a onclick="event.preventDefault();document.getElementById('delete-form').submit();"
                           href="{{route('note.create', $item->slug)}}" class="menu_table__delete"
                           data-confirm="This will erase &quot;{{$item->name}}&quot; from ALL devices. This operation is permanent and cannot be undone. Proceed?"
                           rel="nofollow">
                            erase
                        </a>

                        @if(auth()->check())
                            @if(auth()->user()->is_paid)

                                @if($item->is_protected == false)
                                    <a href="{{route('protect', $item->slug)}}" class="menu_table__delete" style="color: gold; margin-left: 5px; font-weight: bold;">
                                        Protect Link
                                    </a>
                                @else
                                    <a href="{{route('unprotect', $item->slug)}}" class="menu_table__delete" style="color: white; margin-left: 5px; font-weight: bold;">
                                        Unprotect Link
                                    </a>
                                @endif

                            @endif
                        @endif

                        <form id="delete-form" action="{{route('note.destroy', $item->slug)}}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>


        @guest
            <p class="info">
                With a <a href="{{route('register')}}" class="hyperlink">free account</a>
                your trees will always be synchronized between your devices.
            </p>
        @endguest
    </div>


    <script>
        function myFunction() {
            var txt;
            var d = new Date();
            var time = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear();
            var txt = prompt("Name your new tree:", "Task for" + ' ' + time);

            if (!txt == null || !txt == "") {
                document.getElementById("name").value = txt;
                document.getElementById('store-form').submit();
            }
        }
    </script>

@endsection
