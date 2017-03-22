@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <p>Thanks for your interest in Air-Stream Wireless, please fill in the application form below, once submitted this will be sent to the commitee for approval, once your membership has been approved you will receive further information and payment insturctions.</p>
                    {!! Former::open(route('register')) !!}
                        @include('members.form', ['registrationForm' => true])
                    {!! Former::submit('Sign Up')->addClass('btn-primary pull-right') !!}
                    {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
