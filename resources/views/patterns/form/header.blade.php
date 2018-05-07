<div class="row">
    <div class="col s12 center form-header">
        @if( isset($form_icon)   )
            <i class="material-icons i-colored large">{{ $form_icon }}</i>
        @endif
        @if( isset($form_name) )
            <h1>@lang( $form_name )</h1>
        @endif
    </div>
</div>
