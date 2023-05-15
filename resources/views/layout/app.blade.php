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



    {{-- EN LOCAL --}}
    {{-- <link rel="stylesheet" href="{{ asset('/datatable/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/datatable/dataTables.bootstrap5.min.css') }}">

 
    <script src="{{ asset('/datatable/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/datatable/dataTables.bootstrap5.min.js') }}"></script>
   
  


    {{-- EN LIGNE --}}

    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script> --}}

</head>
<body>
    @include('partials/header')
    @yield('content')

 <script>
    $(document).ready(function () {
    $('#example').DataTable();
    });
 </script>
</body>
</html>