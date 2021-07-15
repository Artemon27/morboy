<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{asset('js/jquery-3.1.1.min.js')}}">        </script>
        <script src="{{asset('js/sweetalert.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert.css')}}">
        
        <link type="text/css" rel="stylesheet" href="{{asset('css/admin.css')}}" />
    @if (isset($fon)) 
       @if ($fon==1)
       <link type="text/css" rel="stylesheet" href="{{asset('css/fon1.css')}}" />
       @endif
     @endif
        
 
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    </head>
    <body>
        @include('layouts.verh')
        <div class='container2'>
        @yield('content')
        </div>
        @yield('footer')
        <script src="/js/app.js"></script>
    </body>
    
</html>