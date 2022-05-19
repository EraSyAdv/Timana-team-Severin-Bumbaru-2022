<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="_token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body id="page-top">
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('home') }}">Acasa</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('universities') }}">Universitati</a></li>

                        @if(Auth::check())
                            @if(Auth::user()->access != 0)
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('university.view', Auth::user()->access) }}">{{ Auth::user()->name }}</a></li>
                            @else
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ route('addUniversity') }}">{{ Auth::user()->name }}</a></li>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" onclick="event.preventDefault(); this.closest('form').submit();" href="{{ route('logout') }}">Log Out</a></li>
                            </form>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('centerimage')
        @yield('content')
        
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Made with ❤️ and 🔥 <br></h4>
                        <p class="lead mb-0">
                            by Nica Alexandru
                            & Adamache Marius
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.facebook.com/Concursul-de-creativitate-%C3%AEn-IT-Severin-Bumbaru-101083081371845"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" target="_blank" href="https://www.concurssbumbaru.ugal.ro/"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">About Codding</h4>
                        <p class="lead mb-0">
                            This page took {{ round(microtime(true) - LARAVEL_START, 2) }} seconds to render
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Concursul Severin Bumbaru 2022</small></div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <!-- javascript pentru dropdown-->
        @yield('script')
        @yield('universityscript')

    </body>
</html>
