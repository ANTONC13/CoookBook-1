<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Group;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Group $group)
    {
        $list = Auth::user()->super
            ? Receipt::with('user')->orderBy('name')->get()
            : Receipt::where('user_id', Auth::user()->id)->orderBy('name')->get();

        return view(
            'itemlist',
            [
                'list'     => $list,
                'name'     => 'Receipts',
                'url_item' => 'receipt',
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

        return view(
            'receiptcreate',
            [
                'group_list' => Group::all()->sortBy('name'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->merge(
            array(
                'description' => Purifier::clean(
                    $request->input('description')
                )
            )
        );

        $this->validate(
            $request,
            [
                'name'           => 'required|min:3',
                'img_file_name'  => 'required|image:jpg,png,jpeg|max:5000',
                'description'    => 'required|min:10',
            ]
        );

        $receipt = new Receipt;
        $receipt->name          = $request->input('name');
        $receipt->description   = $request->input('description');
        $receipt->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        $receipt->user_id       = Auth::user()->id;

        $receipt->save();

        $group_id_keys = preg_filter('/^group_(\d+)$/', '$1', array_keys($request->input()));
        $receipt->groups()->sync($group_id_keys);

        return redirect('/receipt')->with('success', 'Group added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {

        if ($receipt->user_id != Auth::user()->id) {
            return redirect('/');
        }

        return view(
            'receiptcreate',
            [
                'receipt'       => $receipt,
                'group_list'    => Group::all()->sortBy('name'),
                'group_receipt' => $receipt->groups()->get(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Receipt             $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {

        if ($receipt->user_id != Auth::user()->id) {
            return redirect('/');
        }

        $request->merge(
            array(
                'description' => Purifier::clean(
                    $request->input('description')
                )
            )
        );

        $this->validate(
            $request,
            [
                'name'           => 'required|min:3',
                'description'    => 'required|min:10',
                'img_file_name'  => 'image:jpg,png,jpeg|max:5000',
            ]
        );

        $receipt->name          = $request->input('name');
        $receipt->description   = $request->input('description');

        if ($request->hasFile('img_file_name')) {
            Storage::delete($receipt->img_file_name);
            $receipt->img_file_name = $request->file('img_file_name')->store('public/uploaded_imgs');
        }

        $group_id_keys = preg_filter('/^group_(\d+)$/', '$1', array_keys($request->input()));
        $receipt->save();

        $receipt->groups()->sync($group_id_keys);

        return redirect('/receipt')->with('success', 'Group changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {

        if ($receipt->user_id != Auth::user()->id) {
            return redirect('/');
        }

        Storage::delete($receipt->img_file_name);

        $receipt->groups()->detach($receipt->id);
        $receipt->forceDelete();

        return redirect('/receipt')->with('success', 'Receipt deleted');
    }
}
