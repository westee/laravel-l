<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $id)
    {
        // return "hello world";
        echo $id;
        return [
            'user' => User::findOrFail($id)
        ];

        // return view('user.profile', [
        //     'user' => User::findOrFail($id)
        // ]);
    }

    public function all()
    {
        $user = User::all();
        echo '233';
        return response()->json($user);
        // return view('user.profile', [
        //     'user' => User::findOrFail($id)
        // ]);
    }

    public function index(string $id)
    {
        // return "hello world";
        echo $id;
        return [
            'user' => User::findOrFail($id)
        ];

        // return view('user.profile', [
        //     'user' => User::findOrFail($id)
        // ]);
    }
}
