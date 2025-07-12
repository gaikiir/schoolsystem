<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'EnsureRole:admin']);
    }

    public function showDashboard()
    {
        // $users = User::where('role', 'user')->paginate(4);
        // $admins = User::where('role', 'admin')->paginate(4);
        $total = User::count();
       $users = User::all();
        return view('dashboard', compact('users', 'total',));
    }

    // public function index(){
    //     return view('dashboard');
    // }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
        return redirect()->route('admindash')->with('success', 'User approved successfully.');
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'blocked';
        $user->save();
        return redirect()->route('admindash')->with('success', 'User blocked successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admindash')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admindash')->with('success', 'User deleted successfully.');
    }
}
