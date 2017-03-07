@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Member
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('members.store')) !!}

                        <h4>Members Details</h4>

                        @include('members.form')
                        @include('memberships.form')

                        <hr>
                        {!! Former::submit('Process Membership')->class('btn btn-primary') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop