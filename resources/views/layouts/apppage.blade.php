<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Second Swap</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



    <style>
        
        .navbar-nav .nav-link:hover::before {
            left: 0;
        }
        .dropdown-menu {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            visibility: hidden;
        }
        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
        .navbar-toggler {
            border: none;
            transition: transform 0.3s ease;
            position: relative;
        }
        .navbar-toggler-icon {
            background-image: none;
            display: block;
            width: 30px;
            height: 2px;
            background-color: #fff;
            position: relative;
            transition: all 0.3s ease-in-out;
        }
        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            background-color: #fff;
            position: absolute;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease-in-out;
        }
        .navbar-toggler-icon::before {
            top: -8px;
        }
        .navbar-toggler-icon::after {
            bottom: -8px;
        }
        .navbar-toggler.collapsed .navbar-toggler-icon {
            transform: rotate(0deg);
        }
        .navbar-toggler:not(.collapsed) .navbar-toggler-icon {
            transform: rotate(45deg);
        }
        .navbar-toggler:not(.collapsed) .navbar-toggler-icon::before {
            top: 0;
            transform: rotate(90deg);
        }
        .navbar-toggler:not(.collapsed) .navbar-toggler-icon::after {
            bottom: 0;
            transform: rotate(90deg);
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #ffeb3b !important;
        }
        .navbar-nav .nav-link {
            color: #fff !important; /* Set text color to white */
        }
        .navbar-logo {
            width: 80px; /* Adjust width to better fit the navbar */
            height: auto; /* Maintain aspect ratio */
        }
        .footer-logo {
            width: 100px; /* Adjust width as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm sticky-top" style="background-color:#FF407D;">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="/logo/SecondSwap2.png" alt="SecondSwap Logo" class="navbar-logo">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ url('/about-second-swap') }}" class="text-reset nav-link">Tentang Second Swap</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/tentang-kami') }}" class="text-reset nav-link">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/hubungi-kami') }}" class="text-reset nav-link">Hubungi Kami</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('storage/assets/profile_pic/'.Auth::user()->photo) }}" class="img-fluid rounded-circle" style="max-width: 25px;" alt="profile-picture">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}">
                                        <i class="fas fa-user"></i> Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('products.user_products', Auth::user()->id) }}">
                                        <i class="fas fa-file-image"></i> Barang 
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.chat', Auth::user()->id) }}">
                                        <i class="fas fa-envelope"></i> Pesan
                                    </a>
                                    <a class="dropdown-item" href="{{ route('favorites.index') }}">
                                        <i class="far fa-heart"></i> Favorit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.reviews') }}">
                                        <i class="fas fa-star"></i> Ulasan
                                    </a>
                                    <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Keluar') }}
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

        <main  style="background-color:#8ACDD7;">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Terhubung dengan kami di jejaring sosial:</span>
                </div>
                <!-- Right -->
                <div>
                    <a href="https://www.facebook.com/SecondSwap" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/SecondSwap" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section>
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <img src="/logo/SecondSwap2.png" alt="SecondSwap Logo" class="footer-logo">
                            </h6>
                            <p>
                                Platform andalan Anda untuk menjual dan membeli barang bekas dengan mudah dan terpercaya.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 text-left">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Second Swap
                            </h6>
                            <p>
                                <a href="{{ url('/about-second-swap') }}" class="text-reset">Tentang Second Swap</a>
                            </p>
                            <p>
                                <a href="{{ url('/tentang-kami') }}" class="text-reset">Tentang Kami</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 text-left">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Support
                            </h6>
                            <p>
                                <a href="{{ url('/hubungi-kami') }}" class="text-reset">Hubungi Kami</a>
                            </p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2024 Copyright:
                <a class="text-reset fw-bold" href="#">SecondSwap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
    @yield('')
    @yield('script')
</body>
</html>
