<!DOCTYPE html>

@include('patterns.header')

<html lang="{{ app()->getLocale() }}">
<body>

@include('patterns.top-menu')

<div class="container center">
    <div class='row'>
        <div class="col s12">
            @if (\Session::has('status'))
                <div class="green-text center">
                    <ul>
                        <li>{!! \Session::get('status') !!}</li>
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/materialize.min.js' ) }}"></script>

</body>

</html>
