<!DOCTYPE html>
<html>
<heade>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Blog' }}</title>
    <!-- BootStrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Fonts-Awesome -->
    <link type="text/css" rel="stylesheet" href="{{ url('assets/store/awesome/css/fontawesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ url('assets/store/awesome/css/all.min.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ url("assets/images/favicon.ico") }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ url("assets/css/style.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ url("assets/css/reset.css") }}">
</heade>
<body>

<div class="container">
    @yield('content')
</div>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- BootStrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<!-- BootStrap JS -->
@stack('scripts')
</body>
</html>


