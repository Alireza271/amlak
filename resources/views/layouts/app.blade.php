<!doctype html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->


{{--    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">--}}
{{--    <!-- jQuery library -->--}}


{{--    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>--}}
{{--    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>--}}


<!-- Latest compiled JavaScript -->
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>


                        </li>
                        <li class="nav-item" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('خروج') }}
                            </a>

                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li class="nav-item">
                                <a class="dropdown-item"
                                   @if(\Illuminate\Support\Facades\Auth::user()->is_admin) href="{{route('admin')}}"
                                   @endif
                                   @if(\Illuminate\Support\Facades\Auth::user()->is_attract) href="{{route('attract')}}"
                                   @endif
                                   @if(\Illuminate\Support\Facades\Auth::user()->is_circulation) href="{{route('circulation')}}" @endif

                                >صفحه نخست</a>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin||\Illuminate\Support\Facades\Auth::user()->is_circulation)
                                <li class="nav-item">
                                    <a class="dropdown-item"
                                       href="{{route('add_estate_page')}}"
                                    >ثبت املاک</a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="dropdown-item"
                                       href="{{route('register')}}"
                                    >ثبت کاربر</a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="dropdown-item"
                                       href="{{route('customer_info_form_page')}}"
                                    >ثبت اطلاعات مشتری </a>
                                </li>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->is_attract)
                                <li class="nav-item">
                                    <a class="dropdown-item"
                                       href="{{route('poster_form_page')}}"
                                    >ثبت فعالیت روزانه </a>
                                </li>
                            @endif
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>