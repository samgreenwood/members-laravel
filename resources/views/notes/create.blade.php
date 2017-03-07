@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Record Note for {{$member->username}}
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('notes.store', ['member' => $member->id])) !!}
                        {!! Former::textarea('note') !!}
                        {!! Former::submit('Record Note')->class('btn btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop