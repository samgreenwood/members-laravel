@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$group->name}}
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('groups.update', $group->id))->method('PUT') !!}
                        {!! Former::populate($group) !!}
                        @include('groups.form')
                        {!! Former::submit('Save')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop