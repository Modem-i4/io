<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <!-- Font Awesome -->
    <!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"-->
    <!-- IO Css -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet"  />

</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                @can('isAdmin')
                        <a class="navbar-brand" href="{{ url('/admin/home') }}">
                    @elsecan('isManager')
                        <a class="navbar-brand" href="{{ url('/manager/home') }}">
                    @else
                        <a class="navbar-brand" href="{{ url('/user/home') }}">
                @endcan
                        <img class="mb-1 img-fluid" src="/img/oa_logo.png" alt="Інвентаризація Острозька академія" width="50px"> Інвентаризація ОА
                        {{-- config('app.name','Laravel') --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto list-unstyled">
                            @can('isAdmin')
                            <li class="nav-item mt-2">
                              <a href="#" class="text-dark ml-2 d-flex align-items-center">
                                  <svg class="icon icon-display mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-display"></use></svg>Технічне обладнання
                              </a>
                            </li>
                            <li class="nav-item mt-2">
                              <a href="#" class="ml-2 {{ request()->routeIs('admin.departments.i')  ? 'active' : 'text-dark' }} d-flex align-items-center">
                                  <svg class="icon icon-file-text2 mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-file-text2"></use></svg>Накладні
                              </a>
                            </li>

                            <li class="nav-item mt-2">
                              <a href="#" class="text-dark ml-2 d-flex align-items-center">
                                  <svg class="icon icon-transfer mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-transfer"></use></svg>Передачі
                              </a>
                            </li>
                            <li class="mt-0 pl-1 nav-item dropdown">
                                <a class="nav-link dropdown-toggle ml-2 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon icon-cog mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-cog"></use></svg>Налаштування
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{ route('admin.departments.index') }}" class="dropdown-item d-flex align-items-center {{ request()->routeIs('admin.departments.index')  ? 'active' : 'text-dark' }}">
                                    <svg class="icon icon-home mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-home"></use></svg>Приміщення
                                </a>
                                <a href="#" class="dropdown-item text-dark d-flex align-items-center">
                                    <svg class="icon icon-list mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-list"></use></svg>Типи обладнання
                              </a>

                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.users.index') }}" class="dropdown-item text-dark d-flex align-items-center {{ request()->routeIs('admin.users.index')  ? 'active' : 'text-dark' }}">
                                    <svg class="icon icon-user-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-user-plus"></use></svg>Користувачі
                                </a>
                                <a href="#" class="dropdown-item text-dark d-flex align-items-center">
                                    <svg class="icon icon-users mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-users"></use></svg>Ролі користувачів
                                </a>
                              </div>
                            </li>



                            @endcan
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
                                <a id="navbarDropdownLogin" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    @can('isAdmin')
                                        <span class="badge badge-success">
                                        Адміністратор
                                        </span>
                                    @elsecan('isManager')
                                        <span class="badge badge-primary">
                                        Менеджер
                                        </span>
                                    @else
                                        <span class="badge badge-info">
                                        Користувач
                                        </span>
                                    @endcan
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLogin">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Вийти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <v-app>
                @yield('content')

                <app-snackbar></app-snackbar>
            </v-app>
        </main>

    </div>
        <footer class="footer">
            <div class="container-fluid bg-dark p-3 text-center">
              <span class="text-muted">Всі права захищені</span>
            </div>
        </footer>

    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
