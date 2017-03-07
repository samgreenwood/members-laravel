@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('profile.store')) !!}
                        {!! Former::populate(['member' => $member]) !!}
                        @include('members.form', ['readonly' => ['username']])
                        {!! Former::submit('Save')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop