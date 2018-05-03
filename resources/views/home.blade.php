@extends('layouts.app')

@section('update_password')
    <div class="panel-body">
        @include('patterns.card', [
            'description' => 'Update Password',
            'name'        => 'Update Password',
            'icon'        => 'vpn_key',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => route('password.update'),
                    'name'   => 'Update Password',
                    'icon'   => 'vpn_key',
                ],
            ]
        ] )
    </div>
@endsection

@section('content')

    <h1>Main page</h1>

    <div class="row">
        <div class="col s12">
            <div class="panel-body">
                @include('patterns.card', [
                    'description' => 'Cookbook R/o',
                    'name'        => 'Cookbook',
                    'icon'        => 'collections',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('welcome'),
                            'name'   => 'Cookbook',
                            'icon'   => 'collections',
                        ],
                    ]
                ] )
            </div>
        </div>
    </div>

    <div class="divider divider-wide"></div>

    <div class="row">
        <div class="col s6">
            <div class="panel-body">
                @include('patterns.card', [
                    'description' => 'Groups CRUD',
                    'name'        => 'Groups CRUD',
                    'icon'        => 'create_new_folder',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('group.index'),
                            'name'   => 'Groups CRUD',
                            'icon'   => 'create_new_folder',
                        ],
                    ]
                ] )
            </div>
        </div>
        <div class="col s6">
            <div class="panel-body">
                @include('patterns.card', [
                    'description' => 'Receipts CRUD',
                    'name'        => 'Receipts CRUD',
                    'icon'        => 'book',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('receipt.index'),
                            'name'   => 'Receipts CRUD',
                            'icon'   => 'book',
                        ],
                    ]
                ] )
            </div>
        </div>
    </div>

    <div class="divider divider-wide"></div>

    <div class="row">
        @if ( Auth::user()->super )
            <div class="col s6">
                <div class="panel-body">
                    @include('patterns.card', [
                        'description' => 'Users CRUD',
                        'name'        => 'Users CRUD',
                        'icon'        => 'supervisor_account',
                        'size'        => 'small',
                        'hrefs'       => [
                            [
                                'url'    => route('user.index'),
                                'name'   => 'Users CRUD',
                                'icon'   => 'supervisor_account',
                            ],
                        ]
                    ] )
                </div>
            </div>
            <div class="col s6">@yield('update_password')</div>
        @else
            <div class="col s12">@yield('update_password')</div>
        @endif
    </div>
@endsection
