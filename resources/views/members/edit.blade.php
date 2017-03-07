@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit {{$member->username}}
                    </div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
                            <li role="presentation"><a href="#memberships" aria-controls="memberships" role="tab" data-toggle="tab">Membership</a></li>
                            <li role="presentation"><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                {!! Former::open(route('members.update', $member->id))->method('PUT') !!}
                                {!! Former::populate(['member' => $member]) !!}
                                <h4>Members Details</h4>
                                @include('members.form')
                                {!! Former::submit('Save')->class('btn btn-primary pull-right') !!}
                                {!! Former::close() !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="memberships">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Payment Method</th>
                                        <th>Transaction Reference</th>
                                        <th>Payment Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($member->memberships as $membership)
                                        <tr>
                                            <td>{{$membership->start}}</td>
                                            <td>{{$membership->end}}</td>
                                            <td>{{$membership->payment->type}}</td>
                                            <td>{{$membership->payment->reference}}</td>
                                            <td>{{$membership->payment->date}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a href="{{route('memberships.create', ['member' => $member->id])}}" class="btn btn-primary pull-right">Renew Membership</a>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="notes">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="25%">Date</th>
                                        <th width="50%">Note</th>
                                        <th width="25%">Recorded By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($member->notes as $note)
                                        <tr>
                                        <td>{{$note->created_at->format('Y-m-d h:i:s')}}</td>
                                            <td>{{$note->note}}</td>
                                            <td>{{$note->recordedBy->username}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <a href="{{route('notes.create', ['member' => $member->id])}}" class="btn btn-primary pull-right">Record Note</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>


@stop