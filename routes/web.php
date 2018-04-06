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

Route::get(  '/', 'Controller@welcome' )->name( 'welcome' );

Auth::routes();

Route::get( '/home', 'HomeController@index' )->name( 'home' );

// Disable of adding a new user
Route::any( '/register', 'HomeController@index' );

Route::get( 'img/{name}',  'ImgController@img'  );
Route::get( 'bimg/{name}', 'ImgController@bimg' );
Route::get( 'ajax/welcomeReceiptModalData/{group}', 'Controller@welcomeReceiptModalData' );

Route::get(  'password/update', 'Auth\UpdatePasswordController@showUpdateForm' )->name( 'password.update' );
Route::post( 'password/update', 'Auth\UpdatePasswordController@update' );


Route::get(  'group',                     'GroupController@index'     )->name( 'group.index'    );
Route::get(  'group/{group}/delete',      'GroupController@destroy'   )->name( 'group.delete'   );
Route::get(  'group/create',              'GroupController@create'    )->name( 'group.create'   );
Route::post( 'group',                     'GroupController@store'     )->name( 'group.store'    );
Route::get(  'group/{group}/edit',        'GroupController@edit'      )->name( 'group.edit'     );
Route::post( 'group/{group}/update',      'GroupController@update'    )->name( 'group.update'   );

Route::get(  'receipt',                   'ReceiptController@index'   )->name( 'receipt.index'  );
Route::get(  'receipt/{receipt}/delete',  'ReceiptController@destroy' )->name( 'receipt.delete' );
Route::get(  'receipt/create',            'ReceiptController@create'  )->name( 'receipt.create' );
Route::post( 'receipt',                   'ReceiptController@store'   )->name( 'receipt.store'  );
Route::get(  'receipt/{receipt}/edit',    'ReceiptController@edit'    )->name( 'receipt.edit'   );
Route::post( 'receipt/{receipt}/update',  'ReceiptController@update'  )->name( 'receipt.update' );

Route::get(  'user',                      'UserController@index'      )->name( 'user.index'     );
Route::get(  'user/{user}/delete',        'UserController@destroy'    )->name( 'user.delete'    );
Route::get(  'user/create',               'UserController@create'     )->name( 'user.create'    );
Route::post( 'user',                      'UserController@store'      )->name( 'user.store'     );
Route::get(  'user/{user}/edit',          'UserController@edit'       )->name( 'user.edit'      );
Route::post( 'user/{user}/update',        'UserController@update'     )->name( 'user.update'    );
