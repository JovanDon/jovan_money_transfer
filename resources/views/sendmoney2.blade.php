@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Send money') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('sendmoney_action') }}" aria-label="{{ __('Send Money') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                     <input type="number" class="form-control" aria-label="Amount (to the nearest)"  id="amount" name="amount" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"  value="{{ old('amount') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 style="text-align:center;" >{{ __('Sending Account') }}</h4>
                        <!--@//if($recievers!=null)-->
                        <div class="form-group row">
                            <label for="account_name_sender" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                            <div class="col-md-6">
                            <select id="account_sender" class="form-control{{ $errors->has('account_sender') ? ' is-invalid' : '' }}" name="account_sender" value="{{ old('account_sender') }}" >
                             
                               @inject('AccountsController_ref', 'App\Http\Controllers\HomeController') 
                                
                               @if($AccountsController_ref->getLoggedin_UserAccounts()->isEmpty())
                               <option value="" >You have no account yet!</option>
                               @else
                               <option value="" ></option>
                               @endif

                               @foreach( $AccountsController_ref->getLoggedin_UserAccounts() as $account)
                               <option value="{{$account->id}}" > {{$account->account_name}} {{$account->account_number}}</option>
                               @endforeach
                               
                            <select/>
                            </div>
                            <div class="col-md-2">                            
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#newSendingAcct"  >New Account</button>
                            
                            <input type="hidden" id="Sender_action"  name="Sender_action"  value=""  />
                            </div>
                        </div>
                                              

                        <h4 style="text-align:center;" >{{ __(' Receiver') }}</h4>

                        <!--@//if($recievers!=null)-->
                            <div class="form-group row">
                                <label for="receiver" class="col-md-4 col-form-label text-md-right"> Receiver name</label>

                                <div class="col-md-6">
                                    <select id="receiver" class="form-control{{ $errors->has('receiver') ? ' is-invalid' : '' }}" name="receiver" value="{{ old('receiver') }}" >
                                    <option value="" ></option>
                                    @if($recievers->first()->fname!=null)
                                    @foreach( $recievers as $reciever)
                                        @if($reciever->contact_id!=null && $reciever->fname!="")
                                            <option value="{{$reciever->contact_id}}" > {{$reciever->fname}} {{$reciever->lname}}</option>
                                        @endif
                                    @endforeach
                                    @endif
                                    <select/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="account_name" class="col-md-4 col-form-label text-md-right">Select Account</label>

                                <div class="col-md-6">
                                    <select id="account_name" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_reciever" value="{{ old('account_name') }}" >
                                        <option value="" ></option>
                                    
                                    <select/>
                                </div>

                                <div class="col-md-2">                            
                                    <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#newReceivingAcct"  >New Account</button>
                                    <input type="hidden" id="receiver_action"  name="receiver_action"  value=""  />
                                </div>

                            </div>
                            
                        <!--@//else-->
                        <!--@//endif-->
                        
                        <div class="col-md-6 offset-md-4">
                                    <button type="submit"  class="btn btn-primary">
                                        {{ __('Send money') }}
                                    </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


@if($recievers!=null)
<div class="modal fade" id="newReceivingAcct" tabindex="-1" role="dialog" aria-labelledby="newReceivingAcctLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="receiver_model_label" >Creating New Account for </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ url('addaccount_action4send') }}" >
        @csrf     
       <input  type="hidden"  id="owner_id"  name="owner_id" value="{{$recievers->first()->contact_id}}" required >            
       <input  type="hidden"  id="contact_id"   >
       
        <div class="form-group row">
                        <label for="account_type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>

                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="account_type" id="optionsRadios1" value="mobile_money" checked>
                                    Mobile Money
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="account_type" id="optionsRadios2" value="bank_account">
                                    Bank Account
                                </label>
                                </div>
                        </div>


                          <div class="form-group row">
                            <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name" value="{{ old('account_name') }}" required autofocus>

                                @if ($errors->has('account_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" placeholder="+256742563825" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                @if ($errors->has('account_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
          
        </form>

      </div>

    </div>

  </div>
</div>

<div class="modal fade" id="newSendingAcct" tabindex="-1" role="dialog" aria-labelledby="newSendingAcctLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add My new Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('addaccount_action4send') }}" >   
        @csrf     
       <input  type="hidden"  name="owner_id" value="loggedinUser" required > 
       
        <div class="form-group row">
                        <label for="account_type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>

                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="account_type" id="optionsRadios1" value="mobile_money" checked>
                                    Mobile Money
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="account_type" id="optionsRadios2" value="bank_account">
                                    Bank Account
                                </label>
                                </div>
                        </div>


                          <div class="form-group row">
                            <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                            <div class="col-md-6">
                                <input id="account_name" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name" value="{{ old('account_name') }}" required autofocus>

                                @if ($errors->has('account_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" placeholder="+256742563825" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                @if ($errors->has('account_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

        
        
        
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('submit') }}
                </button>
            </div>
        </div>
         </form>
      </div>
      
    </div>
  </div>
</div>
@endif
@endsection
