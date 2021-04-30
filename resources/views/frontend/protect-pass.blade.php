@extends('frontend.layout')

@section('content')

    <div class="screen">
        <a style="color: white" href="{{route('note.create', $note->slug)}}">
            <h1 class="page_title">{{$note->name}}</h1>
        </a>
        <p>To view/edit the tree please provide the password.</p>

        <br>
        <div>
            <form action="{{route('protect.check', $note->slug)}}" method="post">
                @csrf

                @if(session()->has('password-error'))
                    <p style="color: red;font-size: 14px;margin-top: -15px;">
                        {{session('password-error')}}
                    </p>
                @endif

                <label for="">Password:</label>
                <input name="password" type="password" autofocus required>

                <br><br>
                <button class="blue button" type="submit">Submit</button>
            </form>
        </div>
    </div>

@endsection
