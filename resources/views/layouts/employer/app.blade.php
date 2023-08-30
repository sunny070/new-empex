<!DOCTYPE html>
<html lang="en">

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
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <style>
    .empex {
      width: 52px;
      height: 6px;
      background-image: linear-gradient(to right, #2d9735, #2d9735 50%, #f5cb58 50%, #f5cb58);
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

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0;
    }

    [x-cloak] {
      display: none
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
    .la-line-scale > div {
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
    .la-line-scale > div {
        display: inline-block;
        float: none;
        background-color: currentColor;
        border: 0 solid currentColor;
    }
    .la-line-scale {
        width: 40px;
        height: 32px;
    }
    .la-line-scale > div {
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
    .la-line-scale > div:nth-child(1) {
        -webkit-animation-delay: -1.2s;
        -moz-animation-delay: -1.2s;
            -o-animation-delay: -1.2s;
                animation-delay: -1.2s;
    }
    .la-line-scale > div:nth-child(2) {
        -webkit-animation-delay: -1.1s;
        -moz-animation-delay: -1.1s;
            -o-animation-delay: -1.1s;
                animation-delay: -1.1s;
    }
    .la-line-scale > div:nth-child(3) {
        -webkit-animation-delay: -1s;
        -moz-animation-delay: -1s;
            -o-animation-delay: -1s;
                animation-delay: -1s;
    }
    .la-line-scale > div:nth-child(4) {
        -webkit-animation-delay: -.9s;
        -moz-animation-delay: -.9s;
            -o-animation-delay: -.9s;
                animation-delay: -.9s;
    }
    .la-line-scale > div:nth-child(5) {
        -webkit-animation-delay: -.8s;
        -moz-animation-delay: -.8s;
            -o-animation-delay: -.8s;
                animation-delay: -.8s;
    }
    .la-line-scale.la-sm {
        width: 20px;
        height: 16px;
    }
    .la-line-scale.la-sm > div {
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
    .la-line-scale.la-2x > div {
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
    .la-line-scale.la-3x > div {
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
  @livewireStyles
</head>

<body style="font-family: 'Poppins', sans-serif;" x-cloak x-data="{ employerNcoSelect: false }"
  :class="{'overflow-y-hidden': employerNcoSelect}">
  @section('navbar')
  <div class="w-full bg-white shadow-lg border-b border-gray-200">
    <div x-data="{ mobileMenu: false }"
      class="max-w-7xl mx-auto px-4 flex flex-col md:items-center md:justify-between md:flex-row">
      <div class="py-4 flex flex-row items-center justify-between">
        <a href="{{ route('employer.dashboard') }}"
          class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg focus:outline-none focus:shadow-outline">
          <img src="/images/main/logo.svg" alt="Logo" class="h-9 md:h-12 mr-2">
        </a>
        <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="mobileMenu = !mobileMenu">
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
      <nav :class="{'flex': mobileMenu, 'hidden': !mobileMenu}"
        class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
        <a class="px-4 py-2 mt-2 text-sm text-empex-green font-semibold rounded-lg hover:text-empex-green md:mt-0"
          href="{{ route('employer.dashboard') }}">Dashboard</a>

        <button onclick="Livewire.emit('openModal', 'employer.profile')"
          class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0">Profile</button>

        <form action="{{ route('admin.logout') }}" method="post">
          @csrf
          <button type="submit" class="px-4 py-2 mt-2 text-sm font-semibold md:mt-0 md:hover:text-empex-green">
            <span>Logout</span>
          </button>
        </form>
      </nav>
    </div>
  </div>
  @show

  <main>
    @yield('content')
  </main>

  @livewireScripts
  @livewire('livewire-ui-modal')
</body>

</html>
