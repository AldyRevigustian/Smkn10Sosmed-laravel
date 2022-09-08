<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request){
        if($request->name == null){
            $user = User::where('name', "!=", auth()->user()->name)->get();
            return response()->json([
                'user' => $user,
            ]);
        }


        $user = User::where('name','like',"%".$request->name."%")->where('name', "!=", auth()->user()->name)->get();
        return response()->json([
            'user' => $user,
        ]);
    }
}
