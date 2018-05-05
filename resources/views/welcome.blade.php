@extends('layouts.app', [ 'with_carousel' => 1, 'with_confirm' => 1 ] )

@section('content')

<div class="carousel">
    @foreach( $groups as $group )
        <a class="carousel-item" href="#" onclick="reload_receipts_div({{ $group->id }})">
            <img src="{{ route( 'bimg', basename( $group->img_file_name ) ) }}"/>
            <span class="card-title">{{ $group->name }}</span>
        </a>
    @endforeach
</div>
<div id="receipts_div">
</div>

@endsection
