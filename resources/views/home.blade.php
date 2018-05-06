@extends('layouts.app')

@section('update_password')
    <div class="panel-body">
        @include('patterns.card', [
            'name'        => trans('home.update_password'),
            'icon'        => 'vpn_key',
            'size'        => 'small',
            'hrefs'       => [
                [
                    'url'    => route('password.update'),
                    'name'   => trans('home.update_password'),
                    'icon'   => 'vpn_key',
                ],
            ]
        ] )
    </div>
@endsection

@section('content')

    <h1>@lang('home.header')</h1>

    <div class="row">
        <div class="col s12">
            <div class="panel-body">
                @include('patterns.card', [
                    'name'        => trans('home.cookbook'),
                    'icon'        => 'collections',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('welcome'),
                            'name'   => trans('home.cookbook'),
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
                    'name'        => trans('home.groups_crud'),
                    'icon'        => 'create_new_folder',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('group.index'),
                            'name'   => trans('home.groups_crud'),
                            'icon'   => 'create_new_folder',
                        ],
                    ]
                ] )
            </div>
        </div>
        <div class="col s6">
            <div class="panel-body">
                @include('patterns.card', [
                    'name'        => trans('home.receipts_crud'),
                    'icon'        => 'book',
                    'size'        => 'small',
                    'hrefs'       => [
                        [
                            'url'    => route('receipt.index'),
                            'name'   => trans('home.receipts_crud'),
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
                        'name'        => trans('home.users_crud'),
                        'icon'        => 'supervisor_account',
                        'size'        => 'small',
                        'hrefs'       => [
                            [
                                'url'    => route('user.index'),
                                'name'   => trans('home.users_crud'),
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
