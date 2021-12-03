<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('profile');
    }


    /**
     * Store a newly created resource in storage.
     *
     */
    public function updateEmailAndPhone(Request $request)
    {
        $user = auth()->user();

        // check if request and user emails are the same
        if ($request->email != $user->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->email = $request->email;
        }
        $request->validate([
            'phone_number' => 'max:255|starts_with:+|regex:/^\+[0-9]*$/',
        ]);
        $user->phone_number = $request->phone_number;
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateAddress(Request $request)
    {
        auth()->user()->update($request->all());
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

}
