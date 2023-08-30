<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login to Employment Exchange</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>
  @livewireStyles
  <style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0;
    }
  </style>

  <style>
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
  </style>
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 flex justify-center" style="font-family: 'Poppins', sans-serif;">
  <div class="max-w-screen-xl m-0 sm:m-20 bg-white md:shadow sm:rounded-lg flex justify-center flex-1">
    <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
      <a href="{{ route('web.home') }}">
        <img src="/images/main/logo.svg" class=" mx-auto" />
      </a>
      <div class=" flex flex-col items-center">
        <div class="w-full flex-1 mt-8">
          @livewire('web.login-user')
        </div>
      </div>
    </div>
    <div class="flex-1 bg-gray-50 text-center hidden md:flex rounded-r-md">
      <div class="m-12 md:m-16 w-full overflow-hidden bg-contain bg-center bg-no-repeat"
        style="background-image: url('/images/main/login.svg');"></div>
    </div>
  </div>

  @livewireScripts
</body>

</html>