@extends('layouts.app')

@section('content')

@include('patterns.form.header', [ 'form_icon' => 'cached' ] )

<div class="row">
    <form class="col valign s10 m4 offset-s1 offset-m4" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        @include('patterns.form.input', [ 'field_name' => 'token', 'field_type' => 'hidden', 'required' => 1, 'field_value' => $token ] )
        @include('patterns.form.input', [ 'field_name' => 'email', 'field_description' => 'E-Mail Address', 'field_type' => 'email', 'required' => 1 ] )
        @include('patterns.form.input', [ 'field_name' => 'password', 'field_description' => 'Password', 'field_type' => 'password', 'required' => 1 ] )
        @include('patterns.form.input', [ 'field_name' => 'password_confirmation', 'field_description' => 'Confirm Password', 'field_type' => 'password', 'required' => 1  ] )
        @include('patterns.form.submit' )
    </form>
</div>

@endsection
