<?php
    $hide_context = '';
    $style        = '';

    if( ! isset( $name ) ) {
        $name = '';
    }

    if( ! isset( $description ) ) {
        $description = $name;
    }

    if( ! isset( $size ) ) {
        $size = 'medium';
    }
    elseif ( $size = 'small' ) {
        $style        = 'height:10rem';
        $hide_context = 1;
    }
?>

<div class='row'>
    <div class="col s12">
        <div class="card {{ $size }}" style="{{ $style }}">
            <div class="card-image center">
                <a href="{{ $hrefs[0]['url'] }}">
                    @if( isset( $img_url ) )
                        <img src="{{ $img_url }}" alt="{{ $name }}"/>
                        <span class="card-title">{{ $name  }}@if( isset( $owner ) && $owner ) <br/>/{{ $owner }}/ @endif</span>
                    @elseif( isset( $icon ) )
                        <i class="material-icons large i-colored">{{ $icon }}</i>
                        <div class="i-colored row">{{ $name }}</div>
                    @else
                        &nbsp;
                    @endif
                </a>
            </div>
            @unless( $hide_context )
            <div class="card-content">
                <p>{!! $description !!}</p>
            </div>
            @endunless
            <div class='card-action'>
                @foreach( $hrefs as $href )
                    @if( isset( $href['confirm'] ) )
                        @include('patterns.confirm.body', [
                            'confirm_link_text'   => isset( $href['name'] ) ? $href['name'] : '',
                            'confirm_link_href'   => $href['url'   ],
                            'confirm_link_icon'   => $href['icon'  ],
                            'confirm_form_header' => $href['header'],
                            'confirm_form_text'   => $href['text'  ],
                        ] )
                    @else
                        <label class="label-colored">
                            <a href="{{ $href['url'] }}">
                                <i class="material-icons">{{ $href['icon'] }}</i>
                                {{ isset( $href['name'] ) ? $href['name'] : '' }}
                            </a>
                        </label>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
