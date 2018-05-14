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

function get_locales(){
    return preg_grep( '/[^.]/', scandir( resource_path() . '/lang' ) );
}

function get_locale(){

    $locale  = Request::segment(1);
    $locales = get_locales();

    if (in_array($locale,$locales)) {
        App::setlocale( $locale );
        return $locale;
    }
    else {
        $locale = App::getLocale();
        $path   = Request::path();
        $new_path = '/' . $locale . ( $path && $path != '/' ? '/' . $path : '/home' );

        Route::redirect( $path, $new_path, 301 );
        return '!';
    }
}

function relocalize_url($new_locale){
    $locales_str = join( '|', get_locales() );
    $url         = preg_replace( '/^('.$locales_str.')\/?/', '', Request::path() );
    $url and $url = '/' .$url;

    return $new_locale . $url;
}


Route::get( 'img/{name}',  'ImgController@img'  )->name('img');
Route::get( 'bimg/{name}', 'ImgController@bimg' )->name('bimg');

$locale = get_locale();

Route::prefix($locale)->group(
    function() {

        Route::get( '', 'HomeController@welcome' )->name( 'welcome' );

        Auth::routes();

        Route::get( 'home', 'HomeController@index' )->name( 'home' )->middleware('auth');

        // Disable of adding a new user
        Route::any( 'register', 'HomeController@index' );

        Route::get( 'ajax/welcomeReceiptModalData/{group}', 'HomeController@welcomeReceiptModalData' );

        Route::get(  'password/update', 'Auth\UpdatePasswordController@showUpdateForm' )->name( 'password.update' )->middleware('auth');
        Route::post( 'password/update', 'Auth\UpdatePasswordController@update' )->middleware('auth');

        foreach ( array( 'group', 'receipt', 'user' ) as $group ) {

            Route::prefix( $group )->group(
                function() use ($group) {
                    $controller = ucfirst($group) . 'Controller';
                    $middleware = ['auth','authroot'];

                    Route::get(  '',               $controller.'@index'   )->name( $group.'.index'  )->middleware($middleware);
                    Route::get(  '{group}/delete', $controller.'@destroy' )->name( $group.'.delete' )->middleware($middleware);
                    Route::get(  'create',         $controller.'@create'  )->name( $group.'.create' )->middleware($middleware);
                    Route::post( '',               $controller.'@store'   )->name( $group.'.store'  )->middleware($middleware);
                    Route::get(  '{group}/edit',   $controller.'@edit'    )->name( $group.'.edit'   )->middleware($middleware);
                    Route::post( '{group}/update', $controller.'@update'  )->name( $group.'.update' )->middleware($middleware);
                }
            );
        }
    }
);
