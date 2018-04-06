@extends('layouts.app', ['with_confirm' => 1])

@section('content')

<h1>{{ $name }}</h1>

<div class="row">
    <div class="col l4 m6 s12">
    <div class="panel-body">
        @include('patterns.card', [
            'description' => 'Home',
            'name'        => 'Home',
            'icon'        => 'home',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => url( '/home' ),
                    'name'   => 'Home',
                    'icon'   => 'home',
                ],
            ]
        ] )
    </div>
    </div>
    <div class="col l4 m6 s12">
    <div class="panel-body">
        @include('patterns.card', [
            'description' => 'Create item',
            'name'        => 'Create item',
            'icon'        => 'create_new_folder',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => url( '/' . $url_item . '/create' ),
                    'name'   => 'New',
                    'icon'   => 'create_new_folder',
                ],
            ]
        ] )
    </div>
    </div>
</div>

<div class="divider divider-wide"></div>

<div class="row">
    @foreach ( $list as $item )
        <div class="col l4 m6 s12">
            @include('patterns.card', [
                'description' => $item->description,
                'name'        => $item->name,
                'owner'       => isset( $item->user ) ? $item->user->name : '',
                'img_url'     => isset( $item->img_file_name ) && $item->img_file_name ? url( '/img/' . basename( $item->img_file_name ) ) : NULL,
                'icon'        => isset( $img_placeholder ) ? $img_placeholder : 'image',
                'hrefs'       => [
                    [
                        'url'     => url( '/' . $url_item . '/' . $item->id . '/edit' ),
                        'name'    => '',
                        'icon'    => 'edit',
                    ],
                    [
                        'url'     => url( '/' . $url_item . '/' . $item->id . '/delete' ),
                        'name'    => '',
                        'icon'    => 'delete',
                        'header'  => 'Delete confirmation',
                        'text'    => 'Are you really want to delete item "' . $item->name . '" ?',
                        'confirm' => 1,
                    ],
                ]
            ] )
        </div>
    @endforeach
</div>

@endsection
