<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/fontawesome-free-6.4.0-web/css/all.css')}}">
    <script src="{{ asset('/jquery/JQuery.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="/js/app.js"></script>
    <title>Gestion de membre</title>

   
    {{-- <script src="{{ asset('/datatable/jquery.js') }}"></script> --}}
</head>
<body>
    @include('partials/header')
    @yield('content')


    {{-- <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        </script> --}}
</body>
</html>