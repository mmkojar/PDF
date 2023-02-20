<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $user_profile = Auth::user();
        // return $user_profile;
        return view('profile')->with('user_profile', $user_profile);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',     
            'password' => ['confirmed'],       
        ]);        

        $get_user = Auth::user();
        $password = $request->input('password');

        if($password == null){
            $password = $get_user->password;
        }
        else {
            $password = Hash::make($password);
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $password;
        $user->save();
        Auth::login($user);
        return redirect('/dashboard')->with('success','User Updated Successfuly');
    }

}
