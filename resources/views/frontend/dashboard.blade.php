@extends('frontend.layout')

@section('content')

    <div class="screen">
        <h1 class="page_title ">{{$user->name}}'s account</h1>
        <div class="columns">

            @if(auth()->user()->is_paid == false)
                <div class="columns__column">
                    <dl class="values">
                        <dt>
                            <span class="product_reference ">HOLLY <span class="subproduct plus">PLUS</span></span>
                        </dt>
                        <dd>
                            No subscription
                            <a href="{{route('plans')}}" class="inline_button green">Get HOLLY PLUS</a>
                        </dd>
                    </dl>
                </div>
            @else

                <div class="columns__column">
                    <dl class="values">
                        <dt>
                            <span class="product_reference ">HOLLY <span class="subproduct plus">PLUS</span></span>
                        </dt>
                        <dd>
                            Congratulations! You are a
                            <span class="inline_button green">Premium</span>
                            Member.
                        </dd>
                    </dl>

                </div>
            @endif

        </div>
    </div>


@endsection
