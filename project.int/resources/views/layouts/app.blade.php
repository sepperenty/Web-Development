<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/images/webImages/favicon.ico">
    <title>Jupiler Wedstrijd</title>

    <!-- Styles -->

    <!---fonts---->

    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:900" rel="stylesheet">

    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">



    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body id="back-image">
    <nav class="navbar navbar-default navbar-static-top one-edge-shadow">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logo" src="images/webImages/logo.jpg" alt="">
                </a>
                @if(Auth()->check() && Auth()->user()->isAdmin())
                <a href="/manage" class="navbar-brand" id="nav_item">Beheer</a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" id="nav_item">Login</a></li>
                        <li><a href="{{ url('/register') }}" id="nav_item">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" id="nav_item" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    
        @if(! empty($message))
         <div class="message col-md-12">    
             <div class="container">
                  <p>{{$message}}</p>
             </div>
               </div>
        @endif
  
    
   

    @yield('content')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/base.js"></script>
</body>
</html>
