<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
  <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
  
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title') </title>

  @include('includes.masyarakat.style')
</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    @include('includes.masyarakat.sidebar')
    <div class="flex flex-col flex-1 w-full">

      @include('includes.masyarakat.navbar')

      @yield('content')

      @include('includes.masyarakat.footer')
    </div>
  </div>
  @include('sweetalert::alert')
  @include('includes.masyarakat.script')
</body>

</html>