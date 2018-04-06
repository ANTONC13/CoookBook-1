@extends('layouts.app')

@section('content')

@include('patterns.form.header', [ 'form_icon' => 'lock_open' ] )

<div class="row">
    <form class="col valign s10 m4 offset-s1 offset-m4" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        @include('patterns.form.input', [ 'field_name' => 'email',    'field_description' => 'E-Mail Address', 'field_type' => 'email', 'required' => 1  ] )
        @include('patterns.form.input', [ 'field_name' => 'password', 'field_description' => 'Password', 'field_type' => 'password', 'required' => 1  ] )
        <div class="row">
            <div class="row">
                <div class="col s6">
                    @include('patterns.form.checkbox', [ 'field_name' => 'remember', 'field_description' => 'Remember Me' ] )
                </div>
                <div class="col s6">
                    @include('patterns.form.submit' )
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a class="" href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
        </div>
    </form>
</div>

@endsection
