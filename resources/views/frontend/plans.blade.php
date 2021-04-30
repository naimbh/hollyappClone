@extends('frontend.layout')

@section('content')

    <div class='screen'>
        <h1 class="page_title ">Try <span class="product_reference ">HOLLY <span
                    class="subproduct plus">PLUS</span></span>
            for free for 30 days
        </h1>
        <p>
            Most of HOLLY is free to use.
            Upgrade your account to unlock additional features:
        </p>
        <div class='columns'>
            <div class='columns__column'>
                <div class='highlights'>
                    <div class='highlight'>
                        <div class='highlight__icon'>
                            <span class="icon-tablet icon"></span>
                        </div>
                        <div class='highlight__name'>
                            Use on your smartphone
                        </div>
                        <div class='highlight__desscription'>
                            Get <span class="product_reference is_gray">HOLLY <span
                                    class="subproduct touch">TOUCH</span></span>, an
                            alternative
                            HOLLY interface that is optimized for smartphones.
                        </div>
                    </div>
                    <div class='highlight'>
                        <div class='highlight__icon'>
                            <span class="icon-shield icon"></span>
                        </div>
                        <div class='highlight__name'>
                            Control acccess to your trees
                        </div>
                        <div class='highlight__description'>
                            Secure trees with username and password.
                            Only invited collaborators have access.
                        </div>
                    </div>
                </div>
            </div>
            <div class='columns__column'>
                <div class='highlight'>
                    <div class='highlight__icon'>
                        <span class="icon-rocket icon"></span>
                    </div>
                    <div class='highlight__name'>
                        See changes in realtime
                    </div>
                    <div class='highlight__description'>
                        Get live tree updates from your collaborators, in realtime as they happen.
                    </div>
                </div>
                <div class='highlight'>
                    <div class='highlight__icon'>
                        <span class="icon-gift icon"></span>
                    </div>
                    <div class='highlight__name'>
                        Share <span class="product_reference is_gray">HOLLY <span
                                class="subproduct plus">PLUS</span></span>
                        benefits
                    </div>
                    <div class='highlight__description'>
                        Your collaborators automatically benefit from <span
                            class="product_reference is_gray">HOLLY <span
                                class="subproduct touch">TOUCH</span></span> and realtime tree updates.
                    </div>
                </div>
            </div>
        </div>
        <p>All Of <span class="product_reference ">Our</span>
            <em
                class="neon">Plans</em>:</p>
        <div class='plans'>
            <div class='is_free plan'>
                <div class='plan__name'>
                    Free
                </div>
                <div class='plan__price'>
                    free
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                         
                    </div>
                     
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-ok icon plan__included"></span>
                    </div>
                    <span class="product_reference is_thin is_gray">HOLLY <span
                            class="subproduct shell">SHELL</span></span>
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-remove icon plan__missing"></span>
                    </div>
                    <span class="product_reference is_thin is_gray">HOLLY <span
                            class="subproduct touch">TOUCH</span></span>
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-remove icon plan__missing"></span>
                    </div>
                    Password-secured trees
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-remove icon plan__missing"></span>
                    </div>
                    Realtime tree updates
                </div>
                <div class='plan__bottom'>
                </div>
            </div>
            <div class='is_personal plan'>
                <div class='plan__name'>
                    Premium
                </div>
                <div class='plan__price'>
                    $2
                    <span class='plan__per_month'>
            / month
          </span>
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        2
                    </div>
                    Collaborators
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-ok icon plan__included"></span>
                    </div>
                    <span class="product_reference is_thin is_gray">HOLLY <span
                            class="subproduct shell">SHELL</span></span>
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-ok icon plan__included"></span>
                    </div>
                    <span class="product_reference is_thin is_gray">HOLLY <span
                            class="subproduct touch">TOUCH</span></span>
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-ok icon plan__included"></span>
                    </div>
                    Password-secured trees
                </div>
                <div class='plan__feature'>
                    <div class='plan__value'>
                        <span class="icon-ok icon plan__included"></span>
                    </div>
                    Realtime tree updates
                </div>
                <div class='plan__bottom'>
                    @if(auth()->check())
                        @if(auth()->user()->is_paid)
                            <div class="button">Subscribed!</div>
                        @else
                            <div id="paypal-button-container"></div>
                        @endif
                    @else
                        <a href="{{route('register')}}" class="button green">Subscribe</a>
                    @endif

                </div>
            </div>

            {{--            <span onclick="test()" class="button blue">Test</span>--}}
        </div>
    </div>


    @if(auth()->check())

        @if(auth()->user()->is_paid == false)

            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            {{--            <script src="https://www.paypal.com/sdk/js?client-id=AaRqNXZ8VR8bI1pv96Rjju68EusD2D8Gs8IFj-Ek_Fm0m3SQfyxrOmh3KqJqK1DW8YB7kEB1SsOiTbwr&vault=true" data-sdk-integration-source="button-factory"></script>--}}
            <script
                src="https://www.paypal.com/sdk/js?client-id=AcxlkZqYAUollrotWyKztRFl9QlDF0pXkSUOCGQ2ZHvY5mJtZChfgFUvb5qoN4zPBPc9DiLOAlkoFpuT&vault=true"
                data-sdk-integration-source="button-factory"></script>
            <script>
                paypal.Buttons({
                    style: {
                        shape: 'rect',
                        color: 'blue',
                        layout: 'horizontal',
                        label: 'subscribe'
                    },
                    createSubscription: function (data, actions) {
                        return actions.subscription.create({
                            // 'plan_id': 'P-6G171513W4011154CL5VD7DQ'
                            'plan_id': 'P-7W7757052A320872SL5O6OJA'
                        });
                    },
                    onApprove: function (data, actions) {
                        console.log(data);
                        subscribe(data.subscriptionID);
                    },
                    onError: function (data) {
                        alert('Sorry! Subscription failed. Please try again.');
                    }
                }).render('#paypal-button-container');
            </script>

            {{--update db --}}
            <script>
                function subscribe(id) {
                    axios.post('subscribe/' + id, {
                        subscriptionId: id,
                    })
                        .then((response) => {
                            console.log(response);
                            window.location = '/dashboard';
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            </script>
        @endif

    @endif



@endsection
