<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>EmpEx - Admin</title>
    <style>
        .active {
            color: #2d9735;
        }

        .empex {
            width: 53px;
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

        .select2 {
            width: 100% !important;
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

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 8px;
            right: 5px;
        }

        .input:not(:placeholder-shown)+.label {
            background: #FFF;
            transform: translate(0, -50%);
            opacity: 1;
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
    @livewireStyles
</head>

<body class="bg-gray-50">
    @livewire('admin.navbar')
    <div class="hidden md:block">
        @livewire('admin.sidebar')
    </div>


    @if (request()->route()->getName() == 'admin.placement')
    <section>
        <div class="md:max-w-7xl md:mx-auto md:px-4 flex justify-center">
            <div class="container">
                <div class="flex">
                    <div
                        class="font-sans md:border-b-4 border-empex-yellow flex flex-col text-left sm:flex-row sm:text-left py-1 sm:items-baseline w-full">



                        {{-- {{ request()->is('1/placement') ? 'yes' : 'no' }} --}}

                        @foreach ($districts as $district)
                        <a class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg hover:text-empex-green md:mt-0 {{ request()->is('admin/'.$district->id . '/placement') ? 'bg-green-100 text-empex-green' : '' }}"
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

    <main>
        @yield('content')
    </main>
    @livewireScripts
    @livewire('livewire-ui-modal')
    @yield('loadedScripts')

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
</body>

</html>
