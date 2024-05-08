<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\House;
use App\Models\Area;
use App\Models\Resident;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $house = DB::table('houses')
            ->join('users', 'houses.user_id', '=', 'users.id')
            ->join('areas', 'areas.id', 'houses.area_id')
            ->select('houses.*', 'users.name', 'users.phone', 'areas.area_name')
            ->get();

        return view('pages.house.house', compact('house'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addHousePage()
    {
        $users = User::where('group_id', 3)->pluck('name', 'id');

        // Mendapatkan daftar area
        $areas = Area::pluck('area_name', 'id');

        return view('pages.house.addHouse', compact('users', 'areas'));
    }
    public function addHouse(Request $request)
    {
        if (House::where('user_id', $request->user_id)->exists()) {
            Alert::error('Error', 'The user is already registered.');
            return back()->withErrors(['user_id' => 'The user is already registered.']);
        }
        $request->validate([
            'address' => 'required|string|max:100',
            'user_id' => 'required|integer|exists:users,id',
            'area_id' => 'required|integer|exists:areas,id',
        ]);

        try {
            db::beginTransaction();

            $house = new House();
            $house->address = $request->input('address');
            $house->user_id = $request->input('user_id');
            $house->area_id = $request->input('area_id');

            $house->save();
            db::commit();

            Alert::success('Success', 'Resident House Added');
            return redirect()->route('house.view')->with('success', 'House created successfully!');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed Added Resident House Data');
            return redirect()->back()->with('error', 'Something went wrong!');
        }


    }
    public function editHousePage($id)
    {
        $house = House::where('identifiers', $id)->firstOrFail();
        $users = User::where('group_id', 3)->pluck('name', 'id');
        $areas = Area::pluck('area_name', 'id');
        return view('pages.house.editHouse', compact('house', 'areas', 'users'));
    }

    public function updateHouse(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string|max:100',
            'user_id' => 'required|integer|exists:users,id',
            'area_id' => 'required|integer|exists:areas,id',
        ]);

        $house = House::findOrFail($id);
        $house->address = $request->input('address');
        $house->area_id = $request->input('area_id');
        $house->save();

        Alert::success('Success', 'Resident House Updated');
        return redirect()->route('house.view')->with('success', 'House updated successfully!');
    }

    public function deleteHouse($id)
    {
        try {
            db::beginTransaction();

            $data = House::where('identifiers', $id)->firstOrFail();

            $data->delete();

            db::commit();
            Alert::success('Success', 'House Data Deleted');

            return redirect()->route('house.view');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to Delete house data');
            db::rollBack();
            return redirect()->route('house.view');
        }

    }
}