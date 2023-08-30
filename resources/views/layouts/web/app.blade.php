<!DOCTYPE html>
<html lang="en" class=" scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @livewireStyles
    @livewireScripts
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    {{-- added rj --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>






    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7HX1H8L2HS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-7HX1H8L2HS');
    </script>
    {{-- added rj --}}


    <style>
        .active {
            color: #2d9735;
        }


        .text-blue {
            color: #75b1ff;

        }



        .blink-text {

            animation: animatetext 1.5s linear infinite;
        }


        .empex-gray {
            background-color: #f1f1f1;

        }

        @keyframes animatetext {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 0;
            }
        }

        .auth-active {
            background-color: #e9f3ed;
            color: #2d9735;
            border-radius: 0;
        }

        .empex {
            width: 100px;
            height: 8px;
            background-image: linear-gradient(to right, #2d9735, #2d9735 50%, #f5cb58 50%, #f5cb58);
        }

        @media (max-width: 640px) {
            .empex {
                width: 52px !important;
                height: 6px !important;
            }
        }

        .empex-sm {
            width: 52px;
            height: 6px;
            background-image: linear-gradient(to right, #2d9735, #2d9735 50%, #f5cb58 50%, #f5cb58);
        }

        main {
            min-height: 72vh;
        }

        .input:not(:placeholder-shown)+.label {
            background: #FFF;
            transform: translate(0, -50%);
            opacity: 1;
        }

        .label {
            left: 8px;
            position: absolute;
            top: 0;
            padding: 0 5px;
            opacity: 0;
            transition: all 200ms;
        }

        .label-select2 {
            left: 8px;
            position: absolute;
            top: -8px;
            padding: 0 5px;
            opacity: 1;
            transition: all 200ms;
            background-color: #fff;
        }

        .bg-custom-yellow {
            background-image: url(/images/main/yellow_bg.svg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover
        }
    </style>
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-selection--multiple {
            padding: 2px 4px !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #2d9735;
            color: #fff;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #e9f3ed;
            color: #000;
        }

        .select2-container--default .select2-selection--multiple:before {
            content: ' ';
            display: block;
            position: absolute;
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            right: 10px !important;
            margin-left: -4px;
            margin-top: -2px;
            top: 50%;
            width: 0;
            cursor: pointer
        }

        .select2-container--open .select2-selection--multiple:before {
            content: ' ';
            display: block;
            position: absolute;
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px;
            height: 0;
            right: 10px !important;
            margin-left: -4px;
            margin-top: -2px;
            top: 50%;
            width: 0;
            cursor: pointer
        }
    </style>
    <style>
        [x-cloak] {
            display: none
        }
    </style>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        .no-bg-select {
            background-image: none !important;
        }

        #social-links li {
            display: inline-block;
        }
    </style>

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 8px;
            right: 5px;
        }
    </style>

    <style>
        #Search::-webkit-search-cancel-button {
            position: relative;
            right: 20px;
            cursor: pointer;
        }
    </style>

    {{-- loading indicator --}}
    <style>
        /*!
    * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
    * Copyright 2015 Daniel Cardoso <@DanielCardoso>
    * Licensed under MIT
    */
        .la-line-scale,
        .la-line-scale>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-line-scale {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-line-scale.la-dark {
            color: #333;
        }

        .la-line-scale>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-line-scale {
            width: 40px;
            height: 32px;
        }

        .la-line-scale>div {
            width: 4px;
            height: 32px;
            margin: 2px;
            margin-top: 0;
            margin-bottom: 0;
            border-radius: 0;
            -webkit-animation: line-scale 1.2s infinite ease;
            -moz-animation: line-scale 1.2s infinite ease;
            -o-animation: line-scale 1.2s infinite ease;
            animation: line-scale 1.2s infinite ease;
        }

        .la-line-scale>div:nth-child(1) {
            -webkit-animation-delay: -1.2s;
            -moz-animation-delay: -1.2s;
            -o-animation-delay: -1.2s;
            animation-delay: -1.2s;
        }

        .la-line-scale>div:nth-child(2) {
            -webkit-animation-delay: -1.1s;
            -moz-animation-delay: -1.1s;
            -o-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .la-line-scale>div:nth-child(3) {
            -webkit-animation-delay: -1s;
            -moz-animation-delay: -1s;
            -o-animation-delay: -1s;
            animation-delay: -1s;
        }

        .la-line-scale>div:nth-child(4) {
            -webkit-animation-delay: -.9s;
            -moz-animation-delay: -.9s;
            -o-animation-delay: -.9s;
            animation-delay: -.9s;
        }

        .la-line-scale>div:nth-child(5) {
            -webkit-animation-delay: -.8s;
            -moz-animation-delay: -.8s;
            -o-animation-delay: -.8s;
            animation-delay: -.8s;
        }

        .la-line-scale.la-sm {
            width: 20px;
            height: 16px;
        }

        .la-line-scale.la-sm>div {
            width: 2px;
            height: 16px;
            margin: 1px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .la-line-scale.la-2x {
            width: 80px;
            height: 64px;
        }

        .la-line-scale.la-2x>div {
            width: 8px;
            height: 64px;
            margin: 4px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .la-line-scale.la-3x {
            width: 120px;
            height: 96px;
        }

        .la-line-scale.la-3x>div {
            width: 12px;
            height: 96px;
            margin: 6px;
            margin-top: 0;
            margin-bottom: 0;
        }

        /*
    * Animation
    */
        @-webkit-keyframes line-scale {

            0%,
            40%,
            100% {
                -webkit-transform: scaleY(.4);
                transform: scaleY(.4);
            }

            20% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @-moz-keyframes line-scale {

            0%,
            40%,
            100% {
                -webkit-transform: scaleY(.4);
                -moz-transform: scaleY(.4);
                transform: scaleY(.4);
            }

            20% {
                -webkit-transform: scaleY(1);
                -moz-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @-o-keyframes line-scale {

            0%,
            40%,
            100% {
                -webkit-transform: scaleY(.4);
                -o-transform: scaleY(.4);
                transform: scaleY(.4);
            }

            20% {
                -webkit-transform: scaleY(1);
                -o-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @keyframes line-scale {

            0%,
            40%,
            100% {
                -webkit-transform: scaleY(.4);
                -moz-transform: scaleY(.4);
                -o-transform: scaleY(.4);
                transform: scaleY(.4);
            }

            20% {
                -webkit-transform: scaleY(1);
                -moz-transform: scaleY(1);
                -o-transform: scaleY(1);
                transform: scaleY(1);
            }
        }
    </style>
</head>

<body style="font-family: 'Poppins', sans-serif;" class="{{ request()->is('/') ? 'bg-white' : 'bg-gray-50' }}" x-cloak
    x-data="{ employeeSignupDialog: false, jobSignupDialog: false, employeeDetail: false, renewDialog: false }"
    :class="{ 'overflow-y-hidden': employeeSignupDialog || jobSignupDialog || renewDialog }">
    @section('navbar')
    <div class="w-full bg-white shadow-lg border-b border-gray-200">
        <div x-data="{ mobileMenu: false }"
            class="max-w-7xl mx-auto px-4 flex flex-col md:items-center md:justify-between md:flex-row">
            <div class="py-4 flex flex-row items-center justify-between">
                <a href="{{ route('web.home') }}"
                    class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">
                    <img src="/images/main/logo.svg" alt="Logo" class="h-9 md:h-12 mr-2">
                </a>
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline"
                    @click="mobileMenu = !mobileMenu">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!mobileMenu" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                        <path x-show="mobileMenu" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'flex': mobileMenu, 'hidden': !mobileMenu }"
                class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row {{ auth()->check() && request()->is('jobs') ? 'mt-4' : '' }}">
                @guest
                <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('/') ? 'active' : '' }}"
                    href="{{ route('web.home') }}">Home</a>
                @else
                <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('auth/dashboard') ? 'active' : '' }}"
                    href="{{ route('auth.dashboard') }}">Dashboard</a>
                @endguest

                @guest
                <a class="px-4 cursor-pointer py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0"
                    @click="employeeSignupDialog = true">Employment Card</a>
                @else
                <div @click.away="employmentDropdown = false" class="relative" x-data="{ employmentDropdown: false }">
                    <button @click="employmentDropdown = !employmentDropdown"
                        class="flex flex-row justify-between items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/*') ? 'active' : '' }}">
                        <span>Employment Card</span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': employmentDropdown, 'rotate-0': !employmentDropdown }"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="employmentDropdown" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 md:left-5 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-64 z-10">
                        <div class="px-2 py-2 bg-white rounded-md shadow">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/new-registration') ? 'text-empex-green' : '' }}"
                                href="{{ route('auth.employee.newregistration') }}">New Registration</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/ongoing-application') ? 'text-empex-green' : '' }}"
                                href="{{ route('auth.enrollment.status') }}">Ongoing Application</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/change-request') || request()->is('auth/employee/change-request/*') ? 'text-empex-green' : '' }}"
                                href="{{ route('auth.employee.changerequest') }}">Request for Change</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/enrollment-card') ? 'text-empex-green' : '' }}"
                                href="{{ route('auth.enrollment.card') }}">View Enrollment Card</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ request()->is('auth/employee/enrollment-renew') ? 'text-empex-green' : '' }}"
                                href=" {{ route('auth.enrollment.renew') }}">Enrollment Renew</a>

                            {{-- <a
                                class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green {{ (request()->is('auth/employee/enrollment-surrender')) ? 'text-empex-green' : '' }}"
                                href="{{ route('auth.enrollment.surrender') }}">Surrender of Enrollment</a> --}}
                        </div>
                    </div>
                </div>
                @endguest

                {{-- <a
                    class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('jobs') || request()->is('jobs/*') ? 'active' : '' }}"
                    href="{{ route('web.jobs') }}">Jobs</a> --}}
                <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('employment-news') || request()->is('employment-news/*') ? 'active' : '' }}"
                    href="{{ route('web.jobs') }}">Employment News</a>
{{-- Sunny --}}
                    <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('employment-newsNcs') || request()->is('employment-newsNcs/*') ? 'active' : '' }}"
                        href="{{ route('web.jobsNcs') }}">Employment Ncs News</a>


                <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('career-guidance') || request()->is('career-guidance/*') ? 'active' : '' }}"
                    href="{{ route('web.news') }}">Career Guidance/Articles</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->route()->getName() == 'web.placement'? 'active': '' }}"
                    href="{{ route('web.placement', ['district' => 1]) }}">Placement</a>

                @guest
                <div @click.away="register = false" class="relative" x-data="{ register: false }">
                    <button @click="register = !register"
                        class="flex flex-row justify-between items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 hover:text-empex-green focus:text-empex-green">
                        <span>Register</span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': register, 'rotate-0': !register }"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="register" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 md:left-5 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-64 z-10">
                        <div class="px-2 py-2 bg-white rounded-md shadow">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green"
                                href="{{ route('signup') }}">as Jobseeker/Hna Zawngtu</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green"
                                href="{{ route('register') }}">as Employer/Hna Ruaitu</a>
                        </div>
                    </div>
                </div>

                <div @click.away="login = false" class="relative" x-data="{ login: false }">
                    <button @click="login = !login"
                        class="flex flex-row justify-between items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 hover:text-empex-green focus:text-empex-green">
                        <span>Login</span>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            :class="{ 'rotate-180': login, 'rotate-0': !login }"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="login" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute left-0 md:left-5 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-64 z-10">
                        <div class="px-2 py-2 bg-white rounded-md shadow">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green"
                                href="{{ route('login') }}">as Jobseeker/Hna Zawngtu</a>

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-empex-green focus:text-empex-green"
                                href="{{ route('admin.login') }}">as Employer/Hna Ruaitu</a>
                        </div>
                    </div>
                </div>
                @else
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 mt-2 text-sm font-semibold md:mt-0 md:hover:text-empex-green">
                        <span>Logout</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden md:inline-flex" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
                @endguest
            </nav>
        </div>
    </div>
    @show
    {{-- Placement --}}
    {{-- {{ request()->route()->getName() }} --}}
    @if (request()->route()->getName() == 'web.placement')
    <section>
        <div class="md:max-w-7xl md:mx-auto md:px-4 flex justify-center">
            <div class="container">
                <div class="flex">
                    <div
                        class="font-sans md:border-b-4 border-empex-yellow flex flex-col text-left sm:flex-row sm:text-left py-1 sm:items-baseline w-full">



                        {{-- {{ request()->is('1/placement') ? 'yes' : 'no' }} --}}

                        @foreach ($districts as $district)
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is($district->id . '/placement') ? 'bg-green-100 text-empex-green' : '' }}"
                            href="{{ route(request()->route()->getName() == 'web.placement' ? 'web.placement' : 'admin.placement', ['district' => $district->id]) }}">
                            {{ $district->name }} </a>
                        @endforeach



                        {{-- report --}}




                        {{-- admin control mobile --}}



                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    {{-- Placement --}}
    <main>
        @yield('content')
    </main>

    {{-- employee signup modal --}}
    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
        x-show="employeeSignupDialog" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100">
            <div style="max-height: 27rem;" class="relative bg-white shadow-lg rounded-md text-gray-900 z-20"
                @click.away="employeeSignupDialog = false" x-show="employeeSignupDialog"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                <header class="flex items-center justify-between p-2">
                    <div></div>
                    <button class="focus:outline-none p-2 float-right" @click="employeeSignupDialog = false">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </button>
                </header>
                <main class="p-2 text-center">
                    <div>
                        <img class="mx-auto" src="/images/modal/signup.svg" alt="signup">
                    </div>
                    <div class=" font-semibold text-lg mt-5 text-gray-700">
                        Employment Card siam turin in ziak lut ve rawh le
                    </div>
                    <div class="font-light text-sm text-gray-500">
                        Signup on EmpEx to apply for an Employment Card
                    </div>
                    <div class=" text-gray-700 my-5">
                        I hming leh phone number chauh a ngai e
                        <p class="text-gray-500 text-sm">only name and phone number are required</p>
                    </div>
                    <div class="mb-5">
                        <a href="{{ route('signup') }}"
                            class="bg-empex-green text-gray-100 rounded hover:bg-green-500 px-6 py-1 focus:outline-none">SIGNUP</a>
                    </div>
                </main>
            </div>
        </div>
    </div>

    @section('footer')
    <div class="w-full bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:flex md:justify-between gap-4">
                <div class="flex flex-initial">
                    <img src="/images/lesde_logo1.jpg" alt="lesde_logo" class="h-14">
                    {{-- <img class="mr-8 md:mr-4 h-14" src="/images/footer/emblem.svg" alt="National Emblem">
                    <div class="text-sm text-dark">
                        Initiative of<br> Labour, Employment, Skill Development & Entrepreneurship<br>Government of
                        Mizoram
                    </div> --}}
                </div>
                <a href="https://msegs.in" target="_blank" class="flex flex-initial">
                    <img class="mr-4 h-14" src="/images/footer/msegs_logo.svg" alt="MSeGS Logo">
                    <div class="text-sm text-dark">
                        Designed & Developed by<br>Mizoram State e-Governance Society<br>(A Government of Mizoram
                        Undertaking)
                    </div>
                </a>
            </div>
        </div>
    </div>
    @show

    <div x-data="{ scrollBackTop: false }" x-cloak>
        <button x-show="scrollBackTop"
            x-on:scroll.window="scrollBackTop = (window.pageYOffset > window.outerHeight * 0.5) ? true : false"
            aria-label="Back to top" id="back2Top"
            class="fixed bottom-0 right-0 p-1 md:p-2 mx-5 my-5 bg-empex-green hover:bg-green-600 text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
            </svg>
        </button>
    </div>
    
    @section('copyright')
    <div class="w-full bg-gray-200 py-5 grid grid-cols-3">
        <a href="{{ route('web.privacy') }}"><div class="text-center text-gray-500 col-6">
            Privacy Policy
        </div></a>
       <a href="{{ route('web.terms') }}"> <div class="text-center text-gray-500 col-6">
            Terms and Conditions
        </div>
       </a>
       <a href="{{ route('web.payment-terms') }}" ><div class="text-center text-gray-500 col-6">
            Payment Terms
        </div>
       </a>
    </div>
        <div class="w-full bg-gray-200 py-5">
            <div class="text-center text-gray-500">
                Copyright &copy; 2022 Empex. All rights reserved.
            </div>
        </div>
    @show

    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script>
        function openPopover(event, popoverID) {
            let element = event.target;
            while (element.nodeName !== "BUTTON") {
                element = element.parentNode;
            }
            var popper = Popper.createPopper(element, document.getElementById(popoverID), {
                placement: 'left'
            });
            document.getElementById(popoverID).classList.toggle("hidden");
        }
    </script>

    <script>
        {
            const back2Top = document.querySelector('#back2Top');
            back2Top.addEventListener('click', (e) => {
                e.preventDefault();
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            });
        }

        $("#videoTutorialTrigger").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#videoTutorialPlaceholder").offset().top
            }, 1000);
        });
    </script>

    <script src="{{ asset('js/share.js') }}"></script>

</body>

</html>
