@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Renew Membership
                    </div>

                    <div class="panel-body">

                        <p>Hi {{$user->firstname}} {{$user->surname}},</p>
                        <p>Thanks for your wishing to renew your Air-Stream Wireless Membership</p>
                        <p><strong>Your Membership Expires At:</strong> {{$user->expires_at}}</p>
                        <p><strong>Your New Expiry Will Be:</strong> {{$user->renewal_start_date->addYear()}}</p>

                        {!! Former::open(route('membership.renew.store')) !!}
                        {!! Former::number('amount')->value($user->renewal_amount)->prepend('$')->disabled() !!}

                        <div id="payment-form"></div>

                        <script src="https://js.braintreegateway.com/js/braintree-2.31.0.min.js"></script>
                        <script>
                            var clientToken = "{{$clientToken}}";

                            braintree.setup(clientToken, "dropin", {
                                container: "payment-form"
                            });
                        </script>

                        {!! Former::submit('Renew Membership')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop