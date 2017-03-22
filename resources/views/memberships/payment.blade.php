@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Membership Payment
                    </div>

                    <div class="panel-body">

                        <p>Hi {{$user->firstname}} {{$user->surname}}</p>
                        <p>Thanks for your interested in Air-Stream Wireless.</p>
                        <p><strong>Your Membership Was Approved On:</strong> {{$user->approved_at}}</p>
                        <p><strong>Your Membership Will Begin On:</strong> {{\Carbon\Carbon::now()}}</p>
                        <p><strong>Your Membership Will End On:</strong> {{\Carbon\Carbon::now()->addYear()}}</p>

                        <p>If you would like to pay online, please continue using the membership form below. If you would like to pay by Direct Deposit, please use the below details and forward remittance to committee@air-stream.org</p>

                        <p class="col-md-6">
                            <table class="table bordered">
                                <tr>
                                    <th>Bank</th>
                                    <td>Peoples Choice Credit Union</td>
                                </tr>
                                <tr>
                                    <th>Account Name</th>
                                    <td>Air-Stream Wireless Inc.</td>
                                </tr>
                                <tr>
                                    <th>BSB</th>
                                    <td>805050</td>
                                </tr>
                                <tr>
                                    <th>Account Number:</th>
                                    <td>63465589</td>
                                </tr>
                            </table>

                        </p>
                        {!! Former::open(route('members.store')) !!}

                        <div id="payment-form"></div>

                        <script src="https://js.braintreegateway.com/js/braintree-2.31.0.min.js"></script>
                        <script>
                            var clientToken = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJhNTMyZjMwMDAzNTUzM2VhYzc4ZGY4NjM2NThjOTFlNzU3MzgyMzI5MWY3YWUxZDA3ZDYzZmRlYzQyYWJhMjk5fGNyZWF0ZWRfYXQ9MjAxNy0wMy0yMVQxMTo0OToyMy43MzA4MTQ1NTYrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";

                            braintree.setup(clientToken, "dropin", {
                                container: "payment-form"
                            });
                        </script>

                        {!! Former::submit('Pay Membership')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop