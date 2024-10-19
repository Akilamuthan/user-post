<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Scripts -->
    <style>
        #prodect:hover{
            background-color: white;
            box-shadow: 10px 10px 5px lightblue;
        }
        #admin{
           margin-left:10px;
        }
        #navbar{
            background-color: black;
            width: 200px;
            height: 1000px;  
            position: fixed;
            left:0px;
            top:60px; 
            color: white;
         }
         #items{
            position: relative;
            top:50px;
         }
         #close{
            position:fixed;
            left: 180px;
         }
         .product-img {
            height: 400px; /* Set a fixed height for product images */
            object-fit: cover; /* Maintain aspect ratio */
        }
        #search{
            position:fixed;
            top:80px;
            left: 400px;
        }
        #menuclose{
            margin-left:-5px;
        }
        body {
    overflow-x: hidden; /* Prevents scrolling */
}

    </style>
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
            <div id="admin">

                @if(auth()->user() && auth()->user()->role == "Admin")
                   <form action="{{ route('admin', auth()->user()) }}" method="GET">
                   
                   <button type="submit" class="btn btn-outline-info">Admin</button>
                  </form>   
                   @endif
                </div>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Ecommerce
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
        <div class="row"><div style="display: none" id="navbar">
            <div id="close" >
               <button onclick="closemenu()" id="menuclose" style="border: 0; background-color:black; color:white;">×</button>
            </div>
        
            <br><a href="{{route('order')}}" class="link-underline-primary text-light p-3"><p>Order details</p></a>
                <p>Category</p>

                <form action="categroy" method="get"><button style="padding-left:20px; background-color:black; color:white" name=" name" value="fantasy">fantasy</button></form>

                <form action="categroy" method="get"><button style="padding-left:20px; background-color:black; color:white;" name=" name" value="horror">horror</button></form>

                
            
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



    <script>
        function menu(){
         var navbar=document.getElementById('navbar');
         navbar.style.display="block";
        }
        function closemenu(){
         var navbar=document.getElementById('navbar');
         navbar.style.display="none";
        }
    </script>
</body>
</html>
