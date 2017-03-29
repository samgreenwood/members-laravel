@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Settings</div>
                    <div class="panel-body">
                        {!! Former::open(route('settings.store')) !!}
                        {!! Former::populate($settings) !!}
                        {!! Former::select('forward_email', 'Forward Email')->options(['No', 'Yes'])->help(sprintf('Email will be forwarded to the email address set in your profile (%s)', auth()->user()->email)) !!}
                        {!! Former::submit('Update')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>

            @if(auth()->user()->isNetworkTeam())
                <div class="col-md-6">
            @else
                <div class="col-md-12">
            @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Change Auth Password</div>

                    <div class="panel-body">
                        {!! Former::open(route('password.update.auth')) !!}
                        {!! Former::password('password', 'New Password') !!}
                        {!! Former::password('password_confirmation', 'New Password Confirmation') !!}
                        {!! Former::submit('Change Password')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
            @if(auth()->user()->isNetworkTeam())
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Change Network Password</div>
                        <div class="panel-body">
                            {!! Former::open(route('password.update.nas')) !!}
                            {!! Former::password('nas_password', 'New Password') !!}
                            {!! Former::password('nas_password_confirmation', 'New Password Confirmation') !!}
                            {!! Former::submit('Change Network Password')->class('btn btn-primary pull-right') !!}
                            {!! Former::close() !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>

        </div>
    </div>


@stop