@extends('layouts.app')

@section('content')

@include('patterns.form.header', [ 'form_icon' => 'cached' ] )

<div class="row">
    <form class="col valign s10 m4 offset-s1 offset-m4" method="POST" action="{{ route('password.update') }}">
        {{ csrf_field() }}
        @include('patterns.form.input', [ 'field_name' => 'current_password',      'field_description' => 'Current password', 'field_type' => 'password', 'required' => 1 ] )
        @include('patterns.form.input', [ 'field_name' => 'password',              'field_description' => 'Password',         'field_type' => 'password', 'required' => 1 ] )
        @include('patterns.form.input', [ 'field_name' => 'password_confirmation', 'field_description' => 'Confirm Password', 'field_type' => 'password', 'required' => 1 ] )
        @include( 'patterns.form.back' )
        @include( 'patterns.form.submit' )
    </form>
</div>

@endsection
