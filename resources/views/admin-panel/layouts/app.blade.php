<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Gentelella Alela!</title>

    <!-- Bootstrap -->
    <link href="{{asset('admin-panel/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.css"
        integrity="sha512-ITS8GbPjCRA7c/PBl6Kqb9XjvQbKMBXpzEmpi7BgRwf6mUCySmHbF9opWfVUQvbdiYouDYxhxttWS+wyq4l+Ug=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Theme Style -->
    <link href="{{asset('/admin-panel/css/custom.min.css')}}" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            @include('admin-panel.layouts.sidebar')

            @include('admin-panel.layouts.navbar')

            @yield('content')


        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin-panel/js/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin-panel/js/bootstrap.bundle.min.js')}}"></script>
    <!-- FastClick -->

    <!-- Custom Theme Scripts -->
    <script src="{{asset('admin-panel/js/custom.min.js')}}"></script>

</body>

</html>