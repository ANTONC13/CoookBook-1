<?php
    global $confirm_form_id;
    $confirm_form_header     = isset( $confirm_form_header ) ? $confirm_form_header : 'Udefined header';
    $confirm_form_text       = isset( $confirm_form_text )   ? $confirm_form_text   : 'Undefined text';
    $confirm_link_href       = isset( $confirm_link_href )   ? $confirm_link_href   : '#!';
    $confirm_link_text       = isset( $confirm_link_text )   ? $confirm_link_text   : 'Undefined link text';
    $confirm_link_icon       = isset( $confirm_link_icon )   ? $confirm_link_icon   : '';
?>

  <div id="confirm_form_{{ $confirm_form_id }}" class="modal">
    <div class="modal-content">
      <h4>{{ $confirm_form_header }}</h4>
      <p>{{ $confirm_form_text }}</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect btn-flat ">
            <i class="material-icons red-text">clear</i>
            @lang('confirm.cancel')
        </a>
        <a href="{{ $confirm_link_href }}" class="modal-action modal-close waves-effect btn-flat ">
            <i class="material-icons green-text">check</i>
            @lang('confirm.ok')
        </a>
    </div>
  </div>

  <label class="label-colored">
    <a class="modal-trigger" href="#confirm_form_{{ $confirm_form_id }}">
        <i class="material-icons">{{ $confirm_link_icon }}</i>
        {{ $confirm_link_text }}
    </a>
</label>

<?php
    $confirm_form_id++;
?>
