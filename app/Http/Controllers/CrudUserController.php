<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CrudUserController extends BaseController
{
    // 1. Login page
    public function login()
    {
        return view('auth.login');
    }

    // 2. Handle login submission
    public function authUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
		
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.list');
        }

        return back()->withErrors(['email' => 'Invalid login details']);
    }

    // 3. Register page
    public function createUser()
    {
        return view('auth.register');
    }

    // 4. Handle user registration
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('user.list')->with('success', 'Registration successful!');
    }

    // 5. Show user details
    public function readUser($id)
    {
        $user = User::findOrFail($id);
        return view('auth.read', compact('user'));
    }

    // 6. Delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.list')->with('success', 'User deleted!');
    }

    // 7. Update user page
    public function updateUser($id)
    {
        $user = User::findOrFail($id);
        return view('auth.update', compact('user'));
    }

    // 8. Handle user update
    public function postUpdateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('user.list')->with('success', 'User updated!');
    }

    // 9. List all users
    public function listUser()
    {
        $users = User::all();
        return view('auth.list', compact('users'));
    }

    // 11. Logout
    public function signOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
