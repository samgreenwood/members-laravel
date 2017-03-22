@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$user->firstname}} {{$user->surname}} Application
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {!! Former::open(route('membership.application.approve', $user->id)) !!}
                                {!! Former::submit('Approve Membership')->addClass('btn btn-primary btn-large') !!}
                                {!! Former::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Details</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{$user->firstname}}</td>
                                    </tr>
                                    <tr>
                                        <th>Surname</th>
                                        <td>{{$user->surname}}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td>{{$user->username}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Birthday</th>
                                        <td>{{$user->birthday}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>&nbsp;</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>WIA Member</th>
                                        <td>{!! $user->wia_member ?: '<i class="fa fa-check"></i>' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Affilliated Club</th>
                                        <td>{{$user->affiliated_club}}</td>
                                    </tr>
                                    <tr>
                                        <th>Callsign</th>
                                        <td>{{$user->callsign}}</td>
                                    </tr>
                                    <tr>
                                        <th>Occupation</th>
                                        <td>{{$user->occupation}}</td>
                                    </tr>
                                    <tr>
                                        <th>Referred By</th>
                                        <td>{{$user->referred_by}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Postal Address</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Address 1</th>
                                        <td>{{$user->postal_address_1}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address 2</th>
                                        <td>{{$user->postal_address_2}}</td>
                                    </tr>
                                    <tr>
                                        <th>Suburb</th>
                                        <td>{{$user->postal_address_suburb}}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{$user->postal_address_state}}</td>
                                    </tr>
                                    <tr>
                                        <th>Postcode</th>
                                        <td>{{$user->postal_address_postcode}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{$user->postal_address_country}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Billing Address</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Address 1</th>
                                        <td>{{$user->billing_address_1}}</td>
                                    </tr>
                                    <tr>
                                        <th>Address 2</th>
                                        <td>{{$user->billing_address_2}}</td>
                                    </tr>
                                    <tr>
                                        <th>Suburb</th>
                                        <td>{{$user->billing_address_suburb}}</td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td>{{$user->billing_address_state}}</td>
                                    </tr>
                                    <tr>
                                        <th>Postcode</th>
                                        <td>{{$user->billing_address_postcode}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{$user->billing_address_country}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop