@extends('frontend.layout')

@section('content')

    <div class="screen">
        <a style="color: white" href="{{route('note.create', $note->slug)}}">
            <h1 class="page_title">{{$note->name}}</h1>
        </a>
        <p>To protect the link please provide a password for this tree.</p>

        @if($note->is_protected == true)
            <p style="color: yellow">This link is now protected by password!</p>
        @endif

        <br>
        <div>
            <form action="{{route('protect.password', $note->slug)}}" method="post">
                @csrf
                <label for="">Password:</label>
                <input name="password" type="text" value="{{$note->password == null ? 'secret123' : $note->password}}" autofocus required>

                <br><br>
                <button class="blue button" type="submit">{{$note->password == null ? 'Protect Link' : 'Update Password'}}</button>
            </form>
        </div>
    </div>

@endsection
