<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use App\Models\Staff; 
use App\Models\Resident;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = Group::all();
        return view('auth.register', compact('groups'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'username' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
            'group_id' => 'required|integer',
            'address' => 'required|string|max:500',
        ]);
    
        $group = Group::findOrFail($request->group_id);
        $roles = $group->user_Cat;
    
        // Cek apakah role yang dipilih adalah "PETUGAS"
        if ($roles === 'PETUGAS') {
           
            $petugas = new Staff();
            $petugas->nama_petugas = $request->name;
            $petugas->username = $request->username;
            $petugas->password = Hash::make($request->password);
            $petugas->telp = $request->phone;
            $petugas->level = $request->group_id;
            $petugas->save();
        }

        if($roles =='USER'){
          $resident = Resident::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'username'=> $request->username,
            'address'=> $request->address,
            'group_id'=>$user->group_id,
            'user_id'=>$user->id,
          ]);
        }
    
        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'group_id' => $request->group_id,
            'roles' => $roles,
        ]));
    
        event(new Registered($user));
    
        return redirect(RouteServiceProvider::HOME);
    }
}
