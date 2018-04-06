<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Group;
use App\Receipt;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
