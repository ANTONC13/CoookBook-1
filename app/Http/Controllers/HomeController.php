<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(Request $request)
    {

        return view(
            'welcome',
            [
                'groups' => Group::orderBy('name')->get(),
            ]
        );
    }

    public function welcomeReceiptModalData(Request $request, Group $group)
    {

        return view(
            'patterns/welcomeReceiptModalData',
            [
                'receipts' => $group->receipts()->get(),
            ]
        );
    }
}
