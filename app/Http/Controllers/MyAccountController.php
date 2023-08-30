<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function myProfile(Request $request)
    {
        $data=User::query()->where('id',$request->user_id)->first();
        return response()->json(['data'=>$data]);
    }
}
