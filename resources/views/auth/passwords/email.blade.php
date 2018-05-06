@extends('layouts.app')

@section('content')

@include('patterns.form.header', [ 'form_icon' => 'cached' ] )

<div class="row">
    <form class="col valign s10 m4 offset-s1 offset-m4" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        @include(
            'patterns.form.input',
            [
                'field_name' => 'email',
                'field_type' => 'email',
                'required'   => 1,
            ]
        )
        @include('patterns.form.submit')
    </form>
</div>

@endsection
