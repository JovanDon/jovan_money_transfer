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
                                    <th> Name</th>
                                    <th>Contact/Addres information</th>
                                    <th>Action 1</th>
                                    <th>Action 2</th>
                                    <th>Action 3</th>
                                    <th>Action 4</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($contacts as $contact) 
                                    <tr >
                                        <td>{{$contact->fname}} {{$contact->lname}}</td>
                                        <td>{{$contact->phonenumber}}  {{$contact->email}}  {{$contact->country}}</td>
                                        <td> 
                                            <form action="{{url('sendmoney')}}"  method="post">
                                            @csrf
                                                <input name="contact_id" type="hidden" value="{{$contact->id}}">
                                                <button class="btn btn-success" type="submit">Send money</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{url('addaccount')}}"  method="post">
                                            @csrf
                                                <input name="user_id" type="hidden" value="{{$contact->id}}">
                                                <button class="btn btn-info" type="submit">Add Account</button>
                                            </form>
                                        </td>
                                        <td> 
                                            <form action="{{url('editcontact')}}"  method="post">
                                            @csrf
                                                <input name="contact_id" type="hidden" value="{{$contact->id}}">
                                                <button class="btn btn-warning" type="submit">Edit</button>
                                            </form>
                                        </td>
                                        <td> 
                                            <form action="{{url('deletecontact')}}"  method="post">
                                            @csrf
                                                <input name="contact_id" type="hidden" value="{{$contact->id}}">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
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
 