<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>404 - Not found</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
  <div class="bg-white h-screen justify-center flex">
    <div class="self-center items-center">
      <img src="/images/404.svg" alt="404">
      <div class="text-center">
        <div class="text-4xl font-bold text-gray-800">Page Not Found</div>
        <div class="text-3xl font-bold text-gray-400 mb-5">ERROR 404</div>
        <a href="{{ url()->previous() }}" class="text-empex-green border-empex-green border rounded py-1 px-4">BACK</a>
      </div>
    </div>
  </div>
</body>

</html>