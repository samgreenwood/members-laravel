@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Welcome, {{auth()->user()->username}}.</p>
                            <p>Your membership expires on <strong>{{auth()->user()->expiresAt()}}</strong> ({{auth()->user()->expiresAt()->diffForHumans()}})</p>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
