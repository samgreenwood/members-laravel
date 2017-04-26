@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Payments
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Member</th>
                                <th>Type</th>
                                <th>Transaction Reference</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->id}}</td>
                                    <td>{{$payment->member->firstname}} {{$payment->member->surname}}</td>
                                    <td>{{$payment->type}}</td>
                                    <td>{{$payment->reference}}</td>
                                    <td>{{$payment->date}}</td>
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
