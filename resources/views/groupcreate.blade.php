@extends( 'layouts.app' )

@section( 'content' )

@include( 'patterns.ckeditor-header' )

<?php

    $id            = '';
    $name          = '';
    $description   = '';
    $action        = route( 'group.store' );

    if ( isset( $group ) ) {
        $id            = $group->id;
        $name          = $group->name;
        $description   = $group->description;
        $action        = route( 'group.update', $id );
    }

    if( ! $name        ) $name        = old( 'name'        );
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
                    'field_name'        => 'group',
                    'field_description' => 'group_id',
                    'field_type'        => 'hidden',
                ]
            )
        @endif
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'name',
                'field_description' => 'Group name',
                'required'          => 1,
                'field_value'       => $name,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'img_file_name',
                'field_description' => 'Img file',
                'required'          => 1,
                'field_type'        => 'file',
            ]
        )
        <textarea id="article-ckeditor" name="description" required >{{ $description }}</textarea><br/>
        @include( 'patterns.form.back' )
        @include( 'patterns.form.submit' )
    </form>
</div>

@endsection
