<?php
    $type            = isset( $field_type ) ? $field_type : "text";
    $required        = isset( $required ) && $required ? "required" : "";
    $has_error       = $errors->has( $field_name ) ? 1 : 0;
    $input_class     = $has_error ? 'invalid' : 'validate';
    $data_error_text = $has_error ? $errors->first( $field_name ) : '';
    $value           = isset( $field_value ) ? $field_value : old( $field_name );
    $placeholder     = $has_error || $type == 'password' ? '' : $field_name;
?>

@if( $type == 'hidden' )

    <input type="hidden" name="{{ $field_name }}" value="{{ $value }}">
    @if ( $has_error )
        <p class='red-text'>Somethong went wrong:"{{ $data_error_text }}"! </p>
    @endif

@elseif( $type == 'file' )

    <div class="row file-field input-field">
        <div class="col s2">
            <div class="btn button-colored file-span">{{ $field_description }} <i class="material-icons file-span-i">file_upload</i></div>
            <input type="file" name="{{ $field_name }}">
        </div>
        <div class="col s10 file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>

@else

    <div class="row">
        <div class="input-field col s12">
            <input id="{{ $field_name }}" {{ $required }} placeholder="{{ $placeholder }}" type="{{ $type }}" class="{{ $input_class }}" value="{{ $value }}" name="{{ $field_name }}"/>
            @if ( $has_error )
                <label for="{{ $field_name }}" data-error="{{ $data_error_text }}" >{{ $field_description }}</label>
            @else
                <label for="{{ $field_name }}">{{ $field_description }}</label>
            @endif
        </div>
    </div>

@endif
