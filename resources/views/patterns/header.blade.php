<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom.min.css') }}"/>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script> $(document).ready( function () { $( ".dropdown-button" ).dropdown(); } );</script>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    @if( isset( $with_carousel ) )
        <script src="{{ asset('js/carousel.min.js') }}"></script>
    @endif

    @if( isset( $with_confirm ) )
        @include('patterns.confirm.header')
    @endif

</head>
