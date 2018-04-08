<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = User::orderBy('name')->get();

        return view(
            'itemlist',
            [
                'list'            => $list,
                'name'            => 'User',
                'url_item'        => 'user',
                'img_placeholder' => 'person',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'             => 'required|min:3',
                'email'            => 'required|min:10',
                'img_file_name'    => 'required|image:jpg,png,jpeg|max:5000',
                'password'         => 'required|confirmed|min:6',
            ]
        );

        $user = new User;
        $user->name          = $request->input('name');
        $user->email         = $request->input('email');
        $user->password      = bcrypt($request->input('password'));
        $user->description   = $request->input('description') ?? '';
        $user->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        $user->super         = $request->input('super') || 0;
        $user->save();

        return redirect('/user')->with('success', 'User added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('usercreate', [ 'user' => $user ]);
    }
    // $2y$10$JKd3miJY7Qs7YEKFt1Jl.uIta1IbmLoGxob4ELFb3Y2VkPTzmfd8e
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User                $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $this->validate(
            $request,
            [
                'name'           => 'required|min:3',
                'email'          => 'required|min:10',
                ( $request->input('password') ? ['password' => 'required|min:10'] : [] ),
                'img_file_name'  => 'image:jpg,png,jpeg|max:5000',
            ]
        );

        $user->name          = $request->input('name');
        $user->email         = $request->input('email');
        $user->description   = $request->input('description') ?? '';
        $user->super         = $request->input('super');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('img_file_name')) {
            Storage::delete($user->img_file_name);
            $user->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        }

        $user->save();

        return redirect('/user')->with('success', 'User changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // TODO: Отвызать рецепты в аноним или удалить ???

        Storage::delete($user->img_file_name);

        $user->forceDelete();

        return redirect('/user')->with('success', 'User deleted');
    }
}
