@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Members
                        <a href="{{route('members.create')}}" class="btn btn-xs pull-right">Add Member</a>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Joined</th>
                                <th>Expires</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>{{$member->id}}</td>
                                    <td>{{$member->firstname}} {{$member->surname}}</td>
                                    <td>{{$member->username}}</td>
                                    <td>{{$member->joined_at}}</td>
                                    <td>{{$member->expires_at}}</td>
                                    <td><a href="{{route('members.edit', $member->id)}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>


@stop