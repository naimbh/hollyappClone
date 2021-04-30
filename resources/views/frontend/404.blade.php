@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">Not found</h1>
        <p>
            We're sorry, but we couldn't find the page you requested.
            <br>
            Possible reasons:
        </p>
        <ul class="bullets">
            <li>
                You don't have access to that resource.
            </li>
            <li>
                The resource no longer exists.
            </li>
            <li>
                You mistyped a URL.
            </li>
        </ul>
    </div>

@endsection
