@extends( 'layouts.app' )

@section( 'content' )

@include( 'patterns.ckeditor-header' )

<?php

    $id            = '';
    $name          = '';
    $email         = '';
    $super         = '';
    $description   = '';
    $action        = route( 'user.store' );

    if ( isset( $user ) ) {
        $id            = $user->id;
        $name          = $user->name;
        $email         = $user->email;
        $super         = $user->super;
        $description   = $user->description;

        $action        = route( 'user.update', $id );
    }

    if( ! $name        ) $name        = old( 'name'        );
    if( ! $email       ) $email       = old( 'email'       );
    if( ! $super       ) $super       = old( 'super'       );
    if( ! $description ) $description = old( 'description' );
?>


@include( 'patterns.form.header', [ 'form_icon' => 'cached' ] )

<div class="row">
    <form class="col valign s10 offset-s1" enctype="multipart/form-data" method="POST" action="{{ $action }}">
        {{ csrf_field() }}
        @if ( $id )
            @include(
                'patterns.form.input',
                [
                    'field_value'       => $id,
                    'field_name'        => 'user',
                    'field_description' => 'user_id',
                    'field_type'        => 'hidden',
                ]
            )
        @endif
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'name',
                'field_description' => trans('usercreate.input_name'),
                'required'          => 1,
                'field_value'       => $name,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'email',
                'required'          => 1,
                'field_value'       => $email,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'password',
                'field_type'        => 'password',
                'required'          => isset( $user ) ? 0 : 1,
                'field_value'       => '',
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'password_confirmation',
                'field_type'        => 'password',
                'required'          => isset( $user ) ? 0 : 1,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'img_file_name',
                'field_description' => trans('usercreate.input_img_file_name'),
                'required'          => 1,
                'field_type'        => 'file',
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'description',
                'required'          => 0,
                'field_value'       => $description,
            ]
        )
        @include(
            'patterns.form.checkbox',
            [
                'field_name'        => 'super',
                'field_description' => trans('usercreate.input_super'),
                'checked'           => isset( $user ) ? $super : 0,
            ]
        )
        @include( 'patterns.form.back' )
        @include( 'patterns.form.submit' )
    </form>
</div>

@endsection
