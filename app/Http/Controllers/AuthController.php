<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|unique:users,name',
            'fullname' => 'required|string|unique:users,fullname',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
        $image = $this->saveImage($request->image, 'profiles');

        //create user
        $user = User::create([
            'name' => $attrs['name'],
            'fullname' => $attrs['fullname'],
            'email' => $attrs['email'],
            'image' => $image,
            'password' => bcrypt($attrs['password'])
        ]);

        //return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    // login user
    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // attempt login
        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        //return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    // logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }

    // get user details
    public function user()
    {
        return response([
            'user' => auth()->user()
        ], 200);
    }

    public function userId(Request $request)
    {
        $userId = $request->id;

        $user = User::where('id', $userId)->get();
        return response([
            'user' => $user
        ], 200);
    }

    // update user
    public function update(Request $request)
    {
        $attrs = $request->validate([
            'fullname' => 'required|string',
            'name' => 'required|string'
        ]);

        if($request->image == null){
            $image = auth()->user()->image;
        }else {
            $image = $this->saveImage($request->image, 'profiles');
        }


        auth()->user()->update([
            'fullname' => $attrs['fullname'],
            'name' => $attrs['name'],
            'image' => $image
        ]);

        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);
    }

    // update user
    public function updateNoImage(Request $request)
    {
        $attrs = $request->validate([
            'fullname' => 'required|string',
            'name' => 'required|string'
        ]);

        auth()->user()->update([
            'fullname' => $attrs['fullname'],
            'name' => $attrs['name'],
        ]);

        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);
    }
}
