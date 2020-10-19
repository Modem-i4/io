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
                    <div class="logo mr-3">
                            <a class="navbar-brand" href="
                        @can('isAdmin') {{ url('/admin/home') }}
                        @elsecan('isManager') {{ url('/manager/home') }}
                        @else {{ url('/user/home') }}
                        @endcan ">
                                <img class="mb-1 img-fluid" src="/img/oa_logo.png" alt="Інвентаризація Острозька академія" width="50px"> Інвентаризація ОА{{-- config('app.name','Laravel') --}}
                            </a>
                    </div>
                    <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto list-unstyled">
                            @can('isAdmin')
                                <li class="nav-item">
                                    <a href="#" class="text-dark ml-2 d-flex align-items-center">
                                        <svg class="icon icon-display mx-2" fill="currentColor"><use xlink:href="/img/icons/symbol-defs.svg#icon-display"></use></svg>Технічне обладнання
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="ml-2 {{ request()->routeIs('admin.departments.i')  ? 'active' : 'text-dark' }} d-flex align-items-center">
                                        <svg class="icon icon-file-text2 mx-2" fill="currentColor"><use xlink:href="/img/icons/symbol-defs.svg#icon-file-text2"></use></svg>Накладні
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="text-dark ml-2 d-flex align-items-center">
                                        <svg class="icon icon-transfer mx-2" fill="currentColor"><use xlink:href="/img/icons/symbol-defs.svg#icon-transfer"></use></svg>Передачі
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <div class="d-flex ml-auto align-items-center">
                    <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button-->
                        <button
                            class="navbar-toggler border-0 bg-transparent d-lg-none"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}"
                        >
                            <svg
                                width="20px"
                                height="20px"
                                viewBox="0 0 16 16"
                                class="bi bi-list"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                                />
                            </svg>
                        </button>

                    @can('isAdmin')
                        <div class="dropdown pr-1">
                            <a
                                class="dropdown-toggle gears text-decoration-none pr-1"
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <svg class="icon icon-cog" fill="currentColor"><use xlink:href="/img/icons/symbol-defs.svg#icon-cog"></use></svg>
                            </a>
                            <div class="dropdown-menu gears dropdown-menu-right">
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
                        </div>

                            <a href=""
                            type="button"
                            class="border-0 bg-transparent pr-3"
                            data-toggle="tooltip"
                            data-placement="right"
                            title="{{ __('Вийти') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"

                        >
                            <svg
                                width="1em"
                                height="1em"
                                viewBox="0 0 16 16"
                                class="bi bi-box-arrow-in-right"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8.146 11.354a.5.5 0 0 1 0-.708L10.793 8 8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 1 8z"
                                />
                                <path
                                    fill-rule="evenodd"
                                    d="M13.5 14.5A1.5 1.5 0 0 0 15 13V3a1.5 1.5 0 0 0-1.5-1.5h-8A1.5 1.5 0 0 0 4 3v1.5a.5.5 0 0 0 1 0V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5h-8A.5.5 0 0 1 5 13v-1.5a.5.5 0 0 0-1 0V13a1.5 1.5 0 0 0 1.5 1.5h8z"
                                />
                            </svg>
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="img-fluid rounded" width="45px">
                            <div class="d-none align-items-center px-2 d-sm-flex">
                                <div>
                                    <span>{{ Auth::user()->name }}</span>
                                    <span class="d-block">@can('isAdmin')
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
                                    </span>
                                </div>
                            </div>


                    @endcan
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
