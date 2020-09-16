<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel blog</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/271fb02698.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" id="light" href="https://bootswatch.com/4/litera/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Laravel blog
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index_article', ['page' => 1]) }}">Accéder au blog</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" name="home" href="{{ route('home') }}">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" name="index_article" href="{{ route('index_article', ['page' => 1]) }}">Articles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" name="new_article" href="{{ route('new_article') }}">Ajouter un article</a>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        <div class="container-fluid mb-5">
            <div class="row">
                <div class="col-3 d-none d-lg-block">
                    @auth
                        <div class="m-4">
                            <div class="card w-100 mb-3 justify-content-center mx-auto">
                                <div class="card w-100">
                                    <div class="card-header text-center">
                                        Catégories
                                    </div>
                                    <ul class="list-group list-group-flush text-center">
                                        <li class="list-group-item">
                                            <a href="{{ route('index_article', ['page' => 1]) }}" class="text-decoration-none">
                                                Toutes les catégories
                                            </a>
                                            <span class="badge badge-primary">{{ $nbArticles }}</span>
                                        </li>
                                        @foreach($categories as $category)
                                            <li class="list-group-item">
                                                <a href="{{ route('index_article_by_category', ['category' => $category->id, 'page' => 1]) }}" class="text-decoration-none">
                                                    {{ $category->name }}
                                                </a>
                                                <span class="badge badge-primary">{{ count($category->articles->where('published', 1)) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="col col-lg-7 mr-auto mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
