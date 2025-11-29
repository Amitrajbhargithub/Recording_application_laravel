<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- bootstrap core css -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- fonts style -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet" />
 <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Custom styles for this template -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <!-- responsive style -->
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
        <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
    </head>
    <body class="sub_page">
        @include('layouts.partials.header')
        <main>
            @yield('content')
        </main>
        @include('layouts.partials.newsletter')
        @include('layouts.partials.footer')
    </body>

    <script>
    $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
    </script>
</html>
