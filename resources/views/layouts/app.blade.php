<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <!-- Bootstrap Core CSS -->
 <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<!-- MetisMenu CSS -->
 <link href="{{ asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

<!-- DataTables CSS -->
<link href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!--international phone numbers-->
<link href="{{ asset('intl-tel-input-12.4.0/build/css/intlTelInput.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
    <!--navBar -->
    <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="navbars">Money Transfer</h1>
            </div>

            <div class="bs-component">
              <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="{{ URL::to('home') }}/?key=1">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav mr-auto">                    
                    <li class="nav-item">
                      <a class="nav-link" href="{{ URL::to('contactlist') }}">Contact list</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ URL::to('createaccount') }}">Add My Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ URL::to('createcontact') }}">Add Contact</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ URL::to('viewmytransactions') }}">My transactions</a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
              </nav>
            </div>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
     <!-- Scripts -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="{{ asset('intl-tel-input-12.4.0/build/js/intlTelInput.js') }}"></script>
    
     <script>
  $("#phone").intlTelInput({
       // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: "body",
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
       preferredCountries: ['ug', 'rw','ke'],
      // separateDialCode: true,
      utilsScript: "intl-tel-input-12.4.0/build/js/utils.js"
  });
</script>
 <script>
    //var countryData = $("#phonenumber").intlTelInput("getSelectedCountryData");
  $(document).on('change','#phone',function(){
            
    var countryData = $("#phone").intlTelInput("getSelectedCountryData");
    $("#country").val( countryData.name || $("#country").val());

    var number = $("#phone").intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
    $("#phonenumber").val(number);
    //alert(JSON.stringify(number) );
     });  
  </script> 
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->


<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendor/popper/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('vendor/metisMenu/metisMenu.min.js') }}"></script>
<!-- DataTables JavaScript -->
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/responsive.bootstrap4.js') }}"></script>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true,
            drawCallback: function () {
                $('#dataTables-example_wrapper .row:last-child').addClass('mb-1 align-items-baseline');
            }
        });
    });
</script>
<script>

$("select#account_sender").change(function(){

$.get("{{ url('getaccount_info') }}/?account_id="+$(this).val() +"", function(accountsData){
    //alert(JSON.stringify(accountsData));
    $("input#account_number_sender").val(accountsData[0].account_number); 
    $("#accountNumber_sender_div").show();
});

});


$("#pills-profile-tab").click(function(){

$('#phonenumber_1').prop('disabled', true);
$('#phonenumber_1').prop('required', false);
$('#registeredNames_1').prop('disabled', true);
$('#registeredNames_1').prop('required', false);

$('#bank_name_1').prop('disabled', false);
$('#bank_name_1').prop('required', true);
$('#account_number_1').prop('disabled', false);
$('#account_number_1').prop('required', true);
$('#account_name_1').prop('disabled', false);
$('#account_name_1').prop('required', true);

$('#Sender_action').val('sender_bank');
});

$("#pills-home-tab").click(function(){

$('#phonenumber_1').prop('disabled', false);
$('#phonenumber_1').prop('required', true);
$('#registeredNames_1').prop('disabled', false);
$('#registeredNames_1').prop('required', true);

$('#bank_name_1').prop('disabled', true);
$('#bank_name_1').prop('required', false);
$('#account_number_1').prop('disabled', true);
$('#account_number_1').prop('required', false);
$('#account_name_1').prop('disabled', true);
$('#account_name_1').prop('required', false);
 

$('#Sender_action').val('sender_mm');
});

 

$("#pills-receiver-bank-tab").click(function(){

$('#phonenumber_2').prop('disabled', true);
$('#phonenumber_2').prop('required', false);
$('#registeredNames_2').prop('disabled', true);
$('#registeredNames_2').prop('required', false);

$('#bank_name_2').prop('disabled', false);
$('#bank_name_2').prop('required', true);
$('#account_number_2').prop('disabled', false);
$('#account_number_2').prop('required', true);
$('#account_name_2').prop('disabled', false);
$('#account_name_2').prop('required', true);

$('#receiver_action').val('receiver_bank');
});

$("#pills-receiver-mm-tab").click(function(){

$('#phonenumber_2').prop('disabled', false);
$('#phonenumber_2').prop('required', true);
$('#registeredNames_2').prop('disabled', false);
$('#registeredNames_2').prop('required', true);

$('#bank_name_2').prop('disabled', true);
$('#bank_name_2').prop('required', false);
$('#account_number_2').prop('disabled', true);
$('#account_number_2').prop('required', false);
$('#account_name_2').prop('disabled', true);
$('#account_name_2').prop('required', false);
 

$('#receiver_action').val('receiver_mm');
});

</script>

</body>
</html>
