@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('addaccount_action') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Select Owner') }}</label>

                                <div class="col-md-6">
                                    <select id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" >
                                   @foreach($contactinfo as $contact)
                                   <option value="{{$contact->id}}" >{{$contact->lname}} {{$contact->fname}} </option>
                                   @endforeach
                                    </select>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input  value="{{$contactinfo->first()->phonenumber}}" id="phonenumber" type="text" readonly class="form-control" name="phonenumber" >

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input value="{{$contactinfo->first()->email}}" id="email" type="email" readonly class="form-control" name="email"  >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __(' Country') }}</label>

                            <div class="col-md-6">
                                <input value="{{$contactinfo->first()->country}}"  id="country" type="text" readonly class="form-control" name="country"   >
                                <input value="{{$contactinfo->first()->id}}"  id="owner_id" type="hidden"  class="form-control" name="owner_id"   >

                            </div>
                        </div>
                       
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
</div>
@endsection
