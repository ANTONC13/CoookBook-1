<div id="receipt_carousel" class="carousel">
    @foreach( $receipts as $receipt )
        <a class="carousel-item modal-trigger" href="#receipt_modal_{{ $receipt->id }}">
            <img src="{{ route( 'bimg', basename( $receipt->img_file_name ) ) }}"/>
            <span class="card-title">{{ $receipt->name }}<br/>/{{ $receipt->user->name }}/</span>
        </a>
    @endforeach
</div>

    @foreach( $receipts as $receipt )
        <div id="receipt_modal_{{ $receipt->id }}" class="modal">
            <div class="modal-content">
                <h4>{{ $receipt->name }}<br/>/{{ $receipt->user->name }}/</h4>
                <p>{!! $receipt->description !!}</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
            </div>
        </div>
    @endforeach
