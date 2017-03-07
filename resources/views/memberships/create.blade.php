@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Renew Membership for {{$member->username}}
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('memberships.store', ['member' => $member->id])) !!}
                        {!! Former::populate($form) !!}
                        @include('memberships.form')
                        {!! Former::submit('Renew Membership')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop