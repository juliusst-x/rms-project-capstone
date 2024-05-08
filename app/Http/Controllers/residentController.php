<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class residentController extends Controller
{
    public function index()
    {
        $data = User::whereIn('roles', ['USER'])->get();
        return view('pages.admin.resident', [
            'data' => $data
        ]);
    }

    public function addResidentPage()
    {
        return view('pages.admin.addResident');
    }
    public function addResident(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => ['required', 'numeric', 'digits_between:1,15'],
            'address' => 'required|string|max:500',
            'password' => 'required|string|confirmed|min:8',
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
                'group_id' => 3,
                'roles' => 'USER',
                'level' => 'RESIDENT',
            ]);
            db::commit();

            Alert::success('Success', 'New Resident Added');
            return redirect(route("resident.view"));

        } catch (\Throwable $th) {
            Alert::error('error', "Failed to Add Resident Data");
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }



    public function editResident($id)
    {
        $data = User::where('identifiers', $id)->firstOrFail();
        return view('pages.admin.editResident', compact('data'));
    }

    // Fungsi untuk menyimpan perubahan dari form edit
    public function updateResident(Request $request, $id)
    {
        $resident = User::where('identifiers', $id)->firstOrFail();

        if ($request->email !== $resident->email && User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'The email address is already in use.']);
        }
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => ['required', 'numeric', 'digits_between:1,15'],
            'address' => 'required|string|max:500',
        ], [
            'phone.numeric' => 'The phone number must be a valid number.', // Custom error message for non-numeric phone
            'phone.digits_between' => 'The phone number must have between 1 and 15 digits.', // Custom error message for invalid number of digits
        ]);

        try {

            $resident->name = $request->name;
            $resident->email = $request->email;
            $resident->phone = $request->phone;
            $resident->address = $request->address;

            $resident->save();

            Alert::success('Success', 'Resident Updated');


            return redirect()->route('resident.view');
        } catch (\Throwable $th) {
            Alert::error('error', "Failed to Update Resident Data");
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function deleteResident($id)
    {
        try {
            db::beginTransaction();
            $data = User::where('identifiers', $id)->firstOrFail();

            $data->delete();
            db::commit();
            Alert::success('Success', 'Resident Deleted');
            return redirect()->route('resident.view');
        } catch (\Throwable $th) {
            Alert::error('error', "Failed to Delete Resident Data");
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }

}