<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$locale  = Request::segment(1);

$locales = preg_grep( '/[^.]/', scandir( resource_path() . '/lang' ) );

if ( in_array( $locale, $locales ) ) {
    App::setlocale( $locale );
}
else {
    $locale = App::getLocale();
    Route::redirect( Request::path(), '/' . $locale . '/' . Request::path() );
};

Route::prefix( $locale )->group(
    function() {

        Route::get( '', 'Controller@welcome' )->name( 'welcome' );

        Route::get( 'img/{name}',  'ImgController@img'  );
        Route::get( 'bimg/{name}', 'ImgController@bimg' );

        Auth::routes();

        Route::get( 'home', 'HomeController@index' )->name( 'home' )->middleware('auth');

        // Disable of adding a new user
        Route::any( 'register', 'HomeController@index' );

        Route::get( 'ajax/welcomeReceiptModalData/{group}', 'Controller@welcomeReceiptModalData' );

        Route::get(  'password/update', 'Auth\UpdatePasswordController@showUpdateForm' )->name( 'password.update' )->middleware('auth');
        Route::post( 'password/update', 'Auth\UpdatePasswordController@update' )->middleware('auth');


        Route::get(  'group',                     'GroupController@index'     )->name( 'group.index'    )->middleware('auth');
        Route::get(  'group/{group}/delete',      'GroupController@destroy'   )->name( 'group.delete'   )->middleware('auth');
        Route::get(  'group/create',              'GroupController@create'    )->name( 'group.create'   )->middleware('auth');
        Route::post( 'group',                     'GroupController@store'     )->name( 'group.store'    )->middleware('auth');
        Route::get(  'group/{group}/edit',        'GroupController@edit'      )->name( 'group.edit'     )->middleware('auth');
        Route::post( 'group/{group}/update',      'GroupController@update'    )->name( 'group.update'   )->middleware('auth');

        Route::get(  'receipt',                   'ReceiptController@index'   )->name( 'receipt.index'  )->middleware('auth');
        Route::get(  'receipt/{receipt}/delete',  'ReceiptController@destroy' )->name( 'receipt.delete' )->middleware('auth');
        Route::get(  'receipt/create',            'ReceiptController@create'  )->name( 'receipt.create' )->middleware('auth');
        Route::post( 'receipt',                   'ReceiptController@store'   )->name( 'receipt.store'  )->middleware('auth');
        Route::get(  'receipt/{receipt}/edit',    'ReceiptController@edit'    )->name( 'receipt.edit'   )->middleware('auth');
        Route::post( 'receipt/{receipt}/update',  'ReceiptController@update'  )->name( 'receipt.update' )->middleware('auth');

        Route::get(  'user',                      'UserController@index'      )->name( 'user.index'     )->middleware(['auth','authroot']);
        Route::get(  'user/{user}/delete',        'UserController@destroy'    )->name( 'user.delete'    )->middleware(['auth','authroot']);
        Route::get(  'user/create',               'UserController@create'     )->name( 'user.create'    )->middleware(['auth','authroot']);
        Route::post( 'user',                      'UserController@store'      )->name( 'user.store'     )->middleware(['auth','authroot']);
        Route::get(  'user/{user}/edit',          'UserController@edit'       )->name( 'user.edit'      )->middleware(['auth','authroot']);
        Route::post( 'user/{user}/update',        'UserController@update'     )->name( 'user.update'    )->middleware(['auth','authroot']);
    }
);
