<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

     public  function index()
     {
         $user =User::all();
         return view('users.index')->with('users',$user);
     }
     public function makeAdmin(User $user)
     {
         $user->role = 'admin';

         $user->save();
         return redirect(route('users.index'))->with('status', 'User Made Admin Successfully');




     }

     public function edit()
     {

         return view('users.edit')->with('user', auth()->user());
     }

     public function updateProfile(UpdateProfileRequest $request)
     {
         $user = auth()->user();
         //$user->name = $request['name'];
         //$user->about = $request['about'];

         $user->update([
             'name' => $request->name,
             'about' => $request->about
         ]);



         return redirect(route('users.edit-profile'))->with('status', 'User Profile Updated Successfully');



     }
}
