<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    @yield('style-block')
    <title>@yield('title-block')</title>
</head>
<body class="d-flex flex-column min-vh-100"> 
    @include('includes.header')  

    <main role="main" class="container-fluid py-4 mx-auto big-container">
        <div class="row">
            <nav class="col-md-2 d-md-block bg-light sidebar">
                @role('act')
                    @include('includes.act.menu')
                @endrole
            </nav>
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @role('act')
                @yield('content')
            @endrole
            </div>   
        </div>
    </main>
    @include('includes.footer')
</body>
</html>