@extends('layouts.app')

@section('content')

@include('patterns.ckeditor-header')

<?php
    $id            = '';
    $name          = '';
    $description   = '';
    $action = route( 'receipt.store' );

    if ( isset( $receipt ) ) {
        $id            = $receipt->id;
        $name          = $receipt->name;
        $description   = $receipt->description;
        $action        = route( 'receipt.update', $id );
    }

    if( ! $name        ) $name        = old( 'name'        );
    if( ! $description ) $description = old( 'description' );
?>

@include( 'patterns.form.header', [ 'form_name' => 'receiptcreate.form_name' ] )

<div class="row">
    <form class="col valign s10 offset-s1" enctype="multipart/form-data" method="POST" action="{{ $action }}">
        {{ csrf_field() }}
        @if ( $id )
            @include(
                'patterns.form.input',
                [
                    'field_value'       => $id,
                    'field_name'        => 'receipt',
                    'field_description' => 'receipt_id',
                    'field_type'        => 'hidden',
                ]
            )
        @endif
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'name',
                'field_description' => trans('receiptcreate.input_name'),
                'required'          => 1,
                'field_value'       => $name,
            ]
        )
        @include(
            'patterns.form.input',
            [
                'field_name'        => 'img_file_name',
                'field_description' => trans('receiptcreate.input_name'),
                'required'          => 1,
                'field_type'        => 'file',
            ]
        )
        <div class="row">
        @foreach ( $group_list as $group )
            <div class="col s3">
            @include(
                'patterns.form.checkbox',
                [
                    'field_name'        => 'group_' . $group->id,
                    'field_description' => $group->name,
                    'checked'           => isset( $group_receipt ) ? $group_receipt->firstWhere( 'id', $group->id ) : 0,
                ]
            )
            </div>
        @endforeach
        </div>
        <textarea id="article-ckeditor" name="description" required >{{ $description }}</textarea><br/>
        @include( 'patterns.form.home', [ 'return_to' => route('receipt.index') ] )
        @include( 'patterns.form.submit' )
    </form>
</div>

@endsection
