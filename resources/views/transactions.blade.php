@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                

                <div class="panel-body">
            @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach()
            </div>
        @endif                  

                            <table width="110%" class="table table-striped table-bordered table-responsive-md" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th> Sender</th>
                                    <th>Amount(shs)</th>
                                    <th>Receiver</th>
                                    <th>Transaction Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($transactions as $transaction) 
                                    <tr >
                                        <td>{{$transaction->fname}} {{$transaction->lname}} {{$transaction->account_number}}</td>
                                        <td> {{$transaction->amount}}</td>
                                        <td> {{$transaction->fname_receiver}}  {{$transaction->lname_receiver}}   {{$transaction->account_number_receiver}}</td>
                                        <td>{{$transaction->transactiontime}}</td>
                                    </tr>
                               @endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                     

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 