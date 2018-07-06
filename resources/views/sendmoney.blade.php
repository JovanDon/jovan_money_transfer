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
                        @if($reciever_accounts!=null)
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
                            </div>
                        </div>
                        @else
                        <div style="margin-left:120px;" >
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">get from Mobile money</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">get from Bank</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        
                            <div class="form-group row">
                                <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phonenumber_1" type="text" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                    @if ($errors->has('account_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('account_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="registeredNames" class="col-md-4 col-form-label text-md-right">{{ __('Registered Names') }}</label>

                                <div class="col-md-6">
                                    <input id="registeredNames_1" type="text" placeholder="+256742563825" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="registeredNames" value="{{ old('registeredNames') }}" required autofocus>

                                    @if ($errors->has('registeredNames'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('registeredNames') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            
                                <div class="form-group row">
                                    <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="bank_name_1" type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ old('bank_name') }}" disabled>

                                        @if ($errors->has('bank_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('bank_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="account_name_1" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name" value="{{ old('account_name') }}" disabled>

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
                                    <input id="account_number_1" type="text" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" disabled>

                                    @if ($errors->has('account_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('account_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        <h4 style="text-align:center;" >{{ __('Receiving Account') }}</h4>

                        @if($reciever_accounts!=null)
                            <div class="form-group row">
                                <label for="account_name" class="col-md-4 col-form-label text-md-right">{{$reciever_accounts->first()->fname}} {{$reciever_accounts->first()->lname}}'s Accounts</label>

                                <div class="col-md-6">
                                <select id="account_name" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_reciever" value="{{ old('account_name') }}" >
                                <option value="" ></option>
                                @if($reciever_accounts->first()->account_name!=null)
                                @foreach( $reciever_accounts as $account)
                                <option value="{{$account->id}}" > {{$account->account_name}} {{$account->account_number}}</option>
                                @endforeach
                                @endif
                                <select/>
                                </div>

                                <div class="col-md-2">                            
                                <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target="#newReceivingAcct"  >New Account</button>
                                </div>
                            </div>
                        @else
                        <div style="margin-left:120px;" >
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-receiver-mm-tab" data-toggle="pill" href="#pills-receiver-mm" role="tab" aria-controls="pills-receiver-mm" aria-selected="true">send to Mobile money</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-receiver-bank-tab" data-toggle="pill" href="#pills-receiver-bank" role="tab" aria-controls="pills-receiver-bank" aria-selected="false">send to Bank</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-receiver-mm" role="tabpanel" aria-labelledby="pills-home-tab">
                            
                                <div class="form-group row">
                                    <label for="account_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                    <div class="col-md-6">
                                        <input id="phonenumber_2" type="text" placeholder="+256742563825" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" required autofocus>

                                        @if ($errors->has('account_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('account_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="registeredNames" class="col-md-4 col-form-label text-md-right">{{ __('Registered Names') }}</label>

                                    <div class="col-md-6">
                                        <input id="registeredNames_2" type="text"  class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="registeredNames" value="{{ old('registeredNames') }}" required autofocus>

                                        @if ($errors->has('registeredNames'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('registeredNames') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                            </div>
                            <div class="tab-pane fade" id="pills-receiver-bank" role="tabpanel" aria-labelledby="pills-profile-tab">
                                
                                    <div class="form-group row">
                                        <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="bank_name_2" type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ old('bank_name') }}" disabled>

                                            @if ($errors->has('bank_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="account_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="account_name_2" type="text" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_name" value="{{ old('account_name') }}" disabled >

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
                                            <input id="account_number_2" type="text" class="form-control{{ $errors->has('account_number') ? ' is-invalid' : '' }}" name="account_number" value="{{ old('account_number') }}" disabled >
                                            
                                            @if ($errors->has('account_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('account_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                            </div>
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send money') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@if($reciever_accounts!=null)
<div class="modal fade" id="newReceivingAcct" tabindex="-1" role="dialog" aria-labelledby="newReceivingAcctLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creating New Account for {{$reciever_accounts->first()->fname}} {{$reciever_accounts->first()->lname}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ url('addaccount_action4send') }}" >
        @csrf     
       <input  type="hidden"  name="owner_id" value="{{$reciever_accounts->first()->contact_id}}" required >            
       <input  type="hidden"  name="contact_id" value="{{$reciever_accounts->first()->contact_id}}" required >
       
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
       <input  type="hidden"  name="contact_id" value="{{$reciever_accounts->first()->contact_id}}" required >
       
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
