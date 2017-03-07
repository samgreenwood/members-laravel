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
                        {!! Former::select('forward_email', 'Forward Email')->options(['No', 'Yes']) !!}

                        {!! Former::submit('Update')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Change Auth Password</div>

                    <div class="panel-body">
                        {!! Former::open(route('password.update.auth')) !!}
                        {!! Former::password('password', 'New Password')->help('&nbsp;')!!}
                        {!! Former::password('password_confirmation', 'New Password Confirmation') !!}

                        {!! Former::submit('Change Password')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Change NAS Password</div>
                    <div class="panel-body">
                        {!! Former::open(route('password.update.auth')) !!}
                        {!! Former::password('password', 'New Password')->help('This password is stored insecurely.') !!}
                        {!! Former::password('password_confirmation', 'New Password Confirmation') !!}

                        {!! Former::submit('Change NAS Password')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">OAuth</div>

                    <div class="panel-body">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop