<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Password Update Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password Update requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function update( Request $request ) 
    {

        $this->validate(
            $request, [
            'password'         => 'required|confirmed|min:6',
            'current_password' => 'required|min:6',
             ] 
        );

        $user = Auth::user();

        if (! Hash::check($request->input('current_password'), Auth::user()->password) ) {
            return redirect()->back()->withErrors(
                [ 'current_password' => trans('Current password incorrect') ]
            );
        }

        //Change Password
        $user->password = bcrypt($request->input('password'));
        $user->save();

        Auth::guard()->logout();

        return redirect('/');
    }

    public function showUpdateForm( Request $request ) 
    {
        return view('auth.passwords.update');
    }
}
