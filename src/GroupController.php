<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GroupController extends AuthController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Auth::user()->super) {
            return redirect('/');
        }

        $list = Group::orderBy('name')->get();

        return view(
            'itemlist',
            [
                'list'     => $list,
                'name'     => 'Group',
                'url_item' => 'group',
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
        if (! Auth::user()->super) {
            return redirect('/');
        }

        return view('groupcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Auth::user()->super) {
            return redirect('/');
        }

        $request->merge(array( 'description' => Purifier::clean($request->input('description')) ));

        $this->validate(
            $request,
            [
            'name'           => 'required|min:3',
            'img_file_name'  => 'required|image:jpg,png,jpeg|max:5000',
            'description'    => 'required|min:10',
             ]
        );

        $group = new Group;
        $group->name          = $request->input('name');
        $group->description   = $request->input('description');
        $group->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        $group->user_id       = Auth::user()->id;
        $group->save();

        return redirect('/group')->with('success', 'Group added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        if (! Auth::user()->super) {
            return redirect('/');
        }

        return view('groupcreate', [ 'group' => $group ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Group               $group
     * @return \Illuminate\Http\Response
     */
    public function update(Group $group, Request $request)
    {
        if (! Auth::user()->super) {
            return redirect('/');
        }

        $request->merge(array( 'description' => Purifier::clean($request->input('description')) ));

        $this->validate(
            $request,
            [
            'name'           => 'required|min:3',
            'description'    => 'required|min:10',
            'img_file_name'  => 'image:jpg,png,jpeg|max:5000',
             ]
        );

        $group->name          = $request->input('name');
        $group->description   = $request->input('description');

        if ($request->hasFile('img_file_name')) {
            Storage::delete($group->img_file_name);
            $group->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        }

        $group->save();

        return redirect('/group')->with('success', 'Group changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if (! Auth::user()->super) {
            return redirect('/');
        }

        Storage::delete($group->img_file_name);

        $group->receipts()->detach($group->id);
        $group->forceDelete();

        return redirect('/group')->with('success', 'Group deleted');
    }
}
