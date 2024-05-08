<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class staffController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles !== 'ADMIN') {
            Alert::warning('Warning', 'You don\'t have any access');
            return back();
        }

        $data = User::whereIn('roles', ['STAFF', 'ADMIN'])->get();
        return view('pages.admin.staff.staff', ['data' => $data]);
    }

    public function addStaffPage()
    {
        return view('pages.admin.staff.addStaff');
    }

    public function addStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => ['required', 'numeric', 'digits_between:1,15'],
            'address' => 'required|string|max:500',
            'password' => 'required|string|confirmed|min:8',
            'roles' => 'required|string|in:SECURITY,TRASHMAN'
        ], [
            'phone.numeric' => 'The phone number must be a valid number.', // Custom error message for non-numeric phone
            'phone.digits_between' => 'The phone number must have between 1 and 15 digits.', // Custom error message for invalid number of digits
        ]);

        try {
            db::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->name,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'group_id' => 2,
                'roles' => 'STAFF',
                'level' => $request->roles,
            ]);
            $user->save();
            db::commit();

            Alert::success('Success', 'New Staff Added');
            return redirect(route('staff.view'));
        } catch (\Throwable $th) {
            Alert::error('error', 'Add Staff Failed');
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }

    public function editStaffPage($id)
    {
        $petugas = User::where('identifiers', $id)->firstOrFail();
        return view('pages.admin.staff.editStaff', compact('petugas'));
    }

    public function updateStaff(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:table,column,except,id',
            'email' => 'required|string|email|max:255|unique:users,identifiers',
            'phone' => ['required', 'numeric', 'digits_between:1,15'],
            'address' => 'required|string|max:500',
            'password' => 'nullable|string|confirmed|min:8',
            'roles' => 'required|string|in:SECURITY,TRASHMAN,ADMIN'
        ], [
            'phone.numeric' => 'The phone number must be a valid number.', // Custom error message for non-numeric phone
            'phone.digits_between' => 'The phone number must have between 1 and 15 digits.', // Custom error message for invalid number of digits
        ]);

        try {

            db::beginTransaction();
            $staff = User::where('identifiers', $id)->firstOrFail();

            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            if ($request->filled('password')) {
                $staff->password = Hash::make($request->password);
            }
            $staff->level = $request->roles;

            if ($staff->level == "SECURITY" || $staff->level == "TRASHMAN") {
                $staff->group_id = 2;
                $roles = Group::where('id', $staff->group_id)->value("user_Cat");
                $staff->roles = $roles;
            } elseif ($staff->level == "ADMIN") {
                $staff->group_id = 1;
                $roles = Group::where('id', $staff->group_id)->value("user_Cat");
                $staff->roles = $roles;
            }
            $staff->save();
            db::commit();


            Alert::success('Success', 'Staff Updated');
            return redirect()->route('staff.view');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteStaff($id)
    {
        $petugas = User::where('identifiers', $id)->firstOrFail();
        $petugas->delete();

        Alert::success('Success', 'Staff Deleted');
        return redirect()->route('staff.view');
    }

    
}