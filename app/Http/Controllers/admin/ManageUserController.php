<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('pages.admin.user.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $role = Role::where('name', $request->role_name)->firstOrFail();

        $user->role_id = $role->id;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User role updated successfully.');
    }
}
