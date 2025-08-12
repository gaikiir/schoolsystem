<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'EnsureRole:admin']);
    }

    /**
     * Display the admin dashboard with users and assignments.
    
     */
    public function index()
    {
        $users = User::paginate(2);
        $total = User::count();
        //get the new registered users
        return view('admin.users.index', compact('users', 'total',));
    }

    /**
     * Approve a user.

     */
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        // Clear the student notification from session
        session()->forget('student_notification');

        return redirect()->route('admin.admin.users.index')->with('success', 'User approved successfully.');
    }

    /**
     * Block a user.
     

     */
    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User blocked successfully.');
    }

    /**
     * Show the form for editing a user.
     *
     * @param int $id
 
     */
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,student',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }


    /**
     

    /**
     * Handle new user registration notification (called from registration process).
     */
    public static function notifyNewRegister(User $user)
    {
        // Store the new user registration notification in the session
        session([
            'success' => 'New user registered successfully.',
            'student_notification' => [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'id' => $user->id,
            ]
        ]);
    }


    /**
     * Delete a user.
     *

     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
