@extends('layouts.app', ['with_confirm' => 1])

@section('content')

<h1>{{ $name }}</h1>

<div class="row">
    <div class="col l4 m6 s12">
    <div class="panel-body">
        @include('patterns.card', [
            'name'        => trans('itemlist.home'),
            'icon'        => 'home',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => route('home'),
                    'name'   => trans('itemlist.home'),
                    'icon'   => 'home',
                ],
            ]
        ] )
    </div>
    </div>
    <div class="col l4 m6 s12">
    <div class="panel-body">
        @include('patterns.card', [
            'name'        => trans('itemlist.new'),
            'icon'        => 'create_new_folder',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => route( $url_item . '.create' ),
                    'name'   => trans('itemlist.new'),
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
                        'url'     => route( "$url_item.edit", [ $item->id ] ),
                        'icon'    => 'edit',
                    ],
                    [
                        'url'     => route( "$url_item.delete", [ $item->id ] ),
                        'icon'    => 'delete',
                        'header'  => trans('itemlist.del_confirm'),
                        'text'    => trans('itemlist.del_confirm_text',['name'=>$item->name]),
                        'confirm' => 1,
                    ],
                ]
            ] )
        </div>
    @endforeach
</div>

@endsection
