<?php
    if (!isset($field_description)) {
        $field_description = trans('form.'.$field_name);
    }

    $checked = old( $field_name ) || isset( $checked ) && $checked ? 'checked' : '';
?>

<p class="left">
    <label>
        <input class="checkbox-colored" type="checkbox" id="{{ $field_name }}" name="{{ $field_name }}" {{ $checked }} />
        <span class="label-colored">{{ $field_description }}</span>
    </label>
</p>
<!--
<p>
    <input class="checkbox-colored" type="checkbox" id="{{ $field_name }}" name="{{ $field_name }}" {{ $checked }} />
    <label class="label-colored" for="{{ $field_name }}">{{ $field_description }}</label>
</p>
-->
