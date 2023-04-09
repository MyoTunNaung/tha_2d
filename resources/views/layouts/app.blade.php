<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

  
    <meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
    />


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Digit</title> <!-- {{ config('app.name', 'Digit') }} -->

    <!-- Shourcut Icon ( Favicon ) -->
    <link rel="shortcut icon" type="text/css" href="{{ asset('images/youtube.png') }}">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- jQuery Support -->
    <script src="{{ asset('jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('popper.min.js') }} "></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Select Box -->
      <link href="{{ asset('dist/css/bootstrap-select.css') }}" rel="stylesheet">
    <!-- End Select Box -->

    <!-- Font Awesome -->
    <link  href=" {{ asset('fontawesome-free-5.13.1-web/css/all.min.css') }}" rel="stylesheet">
    <!-- Font Awesome  -->

    <!-- Disable Browser Back -->
    <script>
        $(document).ready(function() {
            function disableBack() {
                window.history.forward()
            }
            window.onload = disableBack();
            window.onpageshow = function(e) {
                if (e.persisted)
                    disableBack();
            }
        });
    </script>
    <!-- Disable Browser Back -->
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"> <!-- {{ config('app.name', 'Digit') }} -->
                Digit
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                  @if(Auth::check())
                   @if(auth()->user()->id == 1 or auth()->user()->id == 2)

                   <!--  <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/user/add') }}">
                                ဒိုင်နဲ့လက်ခွဲများ
                            </a>
                        </li>
                    </ul> -->

                   <!--  <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/customer/add') }}">
                                Customer
                            </a>
                        </li>
                    </ul> -->

                     <!-- <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/workfile/add') }}">
                                ပွဲစဉ်ဇယား
                            </a>
                        </li>
                    </ul>


                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/commission/list') }}">
                                ကော်
                            </a>
                        </li>
                    </ul>

                   

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/break/upd') }}">
                                ဘရိတ်
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/hot/list') }}">
                                ဟော့
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/filepermission/list') }}">
                                ဖိုင် ဖွင့်/ပိတ်
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/digitpermission/list') }}">
                                ဂဏန်း ကန့်သတ်ချက်များ
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/otherpermission/list') }}">
                                ထိုးကြေး ကန့်သတ်ချက်များ
                            </a>
                        </li>
                    </ul> -->


                  <!--   <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/2d/list') }}">
                                2Digit
                            </a>
                        </li>
                    </ul> -->

                    <!-- <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/3d/list') }}">
                                3D စာရင်း
                            </a>
                        </li>
                    </ul>

                    

                    

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/result/list') }}">
                                ပေါက်သီး
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="{{ url('/cash/add') }}">
                                အွန်လိုင်း ငွေစာရင်း
                            </a>
                        </li>
                    </ul> -->


                  @endif
                @endif
                  





                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           <!--  @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <!-- @if(auth()->user()->id != 1 && auth()->user()->id != 2)
                                    <a class="dropdown-item" href="{{ url("/changepassword") }}">
                                        Change Password                                
                                    </a>
                                    @endif -->

                                    <a class="dropdown-item" href="{{ url("/member/list") }}">
                                       Members                                       
                                    </a>

                                   <!--  <a class="dropdown-item" href="{{ url("/user/list/result") }}">
                                        ပေါက်သီး / စာရင်း / စလစ်
                                    </a> 

                                    <a class="dropdown-item" href="{{ url("/ledger/list") }}">
                                        လယ်ဂျာ
                                    </a>
 -->

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                                                    



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>
    </div>



     <!-- Select Box -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }} "></script>
<script src="{{ asset('/dist/js/bootstrap-select.js') }} "></script>

<script>
function createOptions(number) {
  var options = [], _options;

  for (var i = 0; i < number; i++) {
    var option = '<option value="' + i + '">Option ' + i + '</option>';
    options.push(option);
  }

  _options = options.join('');
  
  $('#number')[0].innerHTML = _options;
  $('#number-multiple')[0].innerHTML = _options;

  $('#number2')[0].innerHTML = _options;
  $('#number2-multiple')[0].innerHTML = _options;
}

var mySelect = $('#first-disabled2');

createOptions(4000);

$('#special').on('click', function () {
  mySelect.find('option:selected').prop('disabled', true);
  mySelect.selectpicker('refresh');
});

$('#special2').on('click', function () {
  mySelect.find('option:disabled').prop('disabled', false);
  mySelect.selectpicker('refresh');
});

$('#basic2').selectpicker({
  liveSearch: true,
  maxOptions: 1
});
</script>
 <!-- End Select Box -->

</body>
</html>
