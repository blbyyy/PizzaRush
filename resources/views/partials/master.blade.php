<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/.../css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">
        <link rel="stylesheet" href="css/pizza.css">
        <link rel="stylesheet" href="css/pizzacart.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        @yield('styles')
    </head>
    <body style="background-image: url(images/bg_3.jpg);">
    @include('partials.header')
    <div class="container" >
        @yield('content')
    </div>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js%22%3E%22%3E"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js%22%3E"></script>
    <!-- <script
      src="https://code.jquery.com/jquery-1.12.4.min.js%22%3E</script>
    <script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js" ></script> -->
    @yield('scripts')
    </body>
</html>