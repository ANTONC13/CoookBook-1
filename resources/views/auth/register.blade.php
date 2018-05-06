@extends('layouts.app')

@section('content')

@include('patterns.form.header', [ 'form_icon' => 'person_add' ] )

<div class="row">
    <form class="col valign s10 m4 offset-s1 offset-m4" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        @include(
            'patterns.form.input',
            [
                'field_name' => 'name',
                'field_description' => trans('form.user_name'),
                'required' => 1
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'email',
                'field_type'        => 'email',
                'required'          => 1,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'password',
                'field_type'        => 'password',
                'required'          => 1,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'password_confirmation',
                'field_type'        => 'password',
                'required'          => 1,
            ]
        )
        @include(
            'patterns.form.submit'
        )
    </form>
</div>

@endsection
