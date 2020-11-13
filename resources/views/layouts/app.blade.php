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
                        @can('isAdmin') {{ route('admin.home') }}
                        @elsecan('isManager') {{ url('/manager/home') }}{{-- TODO: Create page and replace with route --}}
                        @else {{ route('user.home') }}
                        @endcan ">
                                <img class="mb-1 img-fluid" src="{{ url('img/oa_logo.png') }}" alt="Інвентаризація Острозька академія" width="50px"> Інвентаризація ОА{{-- config('app.name','Laravel') --}}
                            </a>
                    </div>
                    <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto list-unstyled">
                            @can('isAdmin')
                                <li class="nav-item">
                                    <a href="#" class="text-dark ml-2 {{ navbar_item_class('admin.items.index') }} d-flex align-items-center">
                                        <svg class="icon icon-display mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-display"></use></svg><span class="d-none d-lg-inline">Технічне обладнання</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="ml-2 {{ navbar_item_class('admin.licenses.index') }} d-flex align-items-center">
                                        <svg class="icon icon-file-text2 mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-windows"></use></svg><span class="d-none d-lg-inline">Ліцензії</span>
                                    </a>
                                </li>
                                <li class="nav-item"><a href="{{ route('admin.invoices.index') }}" class="ml-2 {{ navbar_item_class('admin.invoices.index') }} d-flex align-items-center">
                                        <svg class="icon icon-file-text2 mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-file-text2"></use></svg><span class="d-none d-lg-inline">Накладні</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="text-dark ml-2 {{ navbar_item_class('admin.transfers.index') }} d-flex align-items-center">
                                        <svg class="icon icon-transfer mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-transfer"></use></svg><span class="d-none d-lg-inline">Передачі</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <div class="d-flex ml-auto align-items-center">
                        <button
                            class="navbar-toggler border-0 bg-transparent d-lg-none"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}"
                        >
                            <svg class="icon icon-cog"><use xlink:href="/img/icons/symbol-defs.svg#icon-menu"></use></svg>
                        </button>

                    @can('isAdmin')
                        <div class="dropdown pr-1 ml-2">
                            <a
                                class="dropdown-toggle gears text-decoration-none pr-1 "
                                href="#"
                                role="button"
                                id="dropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                <svg class="icon icon-cog"><use xlink:href="/img/icons/symbol-defs.svg#icon-cog"></use></svg>
                            </a>
                            <div class="dropdown-menu gears dropdown-menu-right">
                                <a href="{{ route('admin.users.index') }}" class="dropdown-item text-dark d-flex align-items-center {{ navbar_item_class('admin.users.index') }}">
                                    <svg class="icon icon-user-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-user-plus"></use></svg>Користувачі
                                </a>
                                <a href="#" class="dropdown-item text-dark d-flex align-items-center">
                                    <svg class="icon icon-users mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-users"></use></svg>Ролі користувачів
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.providers.index') }}" class="dropdown-item d-flex align-items-center {{ navbar_item_class('admin.providers.index') }}">
                                    <svg class="icon icon-user-tie mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-user-tie"></use></svg>Постачальники
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.departments.index') }}" class="dropdown-item d-flex align-items-center {{ navbar_item_class('admin.departments.index') }}">
                                    <svg class="icon icon-home mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-home"></use></svg>Приміщення
                                </a>
                                <a href="{{ route('admin.types.index') }}" class="dropdown-item text-dark d-flex align-items-center {{ navbar_item_class('admin.types.index') }}">
                                    <svg class="icon icon-list mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-list"></use></svg>Типи обладнання
                                </a>
                                <a href="{{ route('admin.models.index') }}" class="dropdown-item text-dark d-flex align-items-center {{ navbar_item_class('admin.models.index') }}">
                                    <svg class="icon icon-hardware mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-hardware"></use></svg>Моделі обладнання
                                </a>
                                <a href="{{ route('admin.statuses.index') }}" class="dropdown-item text-dark d-flex align-items-center {{ navbar_item_class('admin.status.index') }}">
                                    <svg class="icon icon-info mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-info"></use></svg>Статуси
                                </a>
                            </div>
                        </div>

                            <a href=""
                            type="button"
                            class="border-0 bg-transparent pr-3 ml-2"
                            data-toggle="tooltip"
                            data-placement="right"
                            title="{{ __('Вийти') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                <svg class="icon icon-cog"><use xlink:href="/img/icons/symbol-defs.svg#icon-exit"></use></svg>
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <img src="{{ auth()->user()->avatar }}" alt="avatar" class="img-fluid rounded" width="45px" title="{{ auth()->user()->name }}">
                            <div class="d-none align-items-center px-2 d-md-flex">
                                <div>
                                    <span>{{ auth()->user()->name }}</span>
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
