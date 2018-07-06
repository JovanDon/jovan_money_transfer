@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('sendmoney_action') }}" aria-label="{{ __('Register') }}">
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
                        </div>
                        <h4 style="text-align:center;" >{{ __('Reciever') }}</h4>

                       

                        <div class="form-group row">
                            <label for="account_name" class="col-md-4 col-form-label text-md-right">{{$reciever_accounts->first()->fname}} {{$reciever_accounts->first()->lname}}'s Accounts</label>

                            <div class="col-md-6">
                            <select id="account_name" class="form-control{{ $errors->has('account_name') ? ' is-invalid' : '' }}" name="account_reciever" value="{{ old('account_name') }}" >
                               <option value="" ></option>
                               @foreach( $reciever_accounts as $account)
                               <option value="{{$account->id}}" > {{$account->account_name}} {{$account->account_number}}</option>
                               @endforeach
                            <select/>
                            </div>
                        </div>

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
@endsection
