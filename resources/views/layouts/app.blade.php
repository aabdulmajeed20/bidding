<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env("APP_NAME")}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="{{ asset('css/historyBidding.css') }}" rel="stylesheet">

    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-dark">
            @if(Auth::guard('provider')->check())
            <a class="navbar-brand" href="{{ url('underwriter/home') }}">Cash 4 Grain</a>
            @else
              <a class="navbar-brand" href="{{ url('/') }}">Cash 4 Grain</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>
            @endif
          <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                @if(Auth::guard('provider')->check())
                  <a class="nav-link" href="{{ route('underwriter.home') }}">Home</a>
                @else
                  <a class="nav-link" href="{{ route('home') }}">Home</a>
                @endif
                </li>
                @if(empty(session()->get('user_id')) && !Auth::guard('provider')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->

                          <li class="nav-item dropdown">
                            @if (Auth::guard('provider')->check())
                                @inject('balance', 'App\MainFunc')


                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::guard('provider')->user()->name}}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  @if ($balance->getBalance())
                                    <div class="dropdown-item">
                                      Balance:
                                      @if ($balance->getBalance() <= 0)
                                        No Balance
                                      @else
                                        @if ($balance->getBalance() == 1)
                                          {{number_format($balance->getBalance())}} Basket
                                        @else
                                          {{number_format($balance->getBalance())}} Baskets
                                        @endif
                                      @endif
                                    </div>
                                  @endif
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('underwriter.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                  </div>
                            @else

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{\App\User::where('_id', Session::get('user_id'))->first()->firstname}}
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
                            @endif

                              </div>
                          </li>
                  </ul>
                @endif
                <li class="nav-item">
                  @if (Auth::guard('provider')->check())
                    <h4 class="text-white">Underwriter Terminal</h4>
                  @elseif (!empty(session()->get('user_id')) && !Auth::guard('provider')->check())
                    <h4 class="text-white">Issuer Terminal</h4>
                  @endif
                </li>
              </ul>
            </div>
        </nav>
        @if(empty(session()->get('user_id')) && !Auth::guard('provider')->check())
          @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
            <script type="text/javascript">
              // window.location.href = "{{route('login')}}"; // This is causing a redirect error when login as underwriter
            </script>
          @endif
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
