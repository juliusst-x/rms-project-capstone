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

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Area::all();
        return view('pages.area.area', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAreaPage()
    {
        return view('pages.area.addArea');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addArea(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'area_name' => 'required|string|max:100',
            'description' => 'required|string|max:100',
        ]);

        try {
            db::beginTransaction();
            $area = new Area();
            $area->area_name = $request->input('area_name');
            $area->description = $request->input('description');

            // Menyimpan data ke database
            $area->save();
            db::commit();

            Alert::success('Success', 'Residence Area Added');

            // Redirect ke halaman index
            return redirect()->route('area.view');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to Add Residence Area');

            // Redirect ke halaman index
            return redirect()->route('area.view');
        }



    }

    public function editAreaPage($id)
    {
        // Jika Anda ingin mengirimkan daftar area ke view
        $area = Area::where('identifiers', $id)->firstOrFail(); // Atau ambil sesuai kebutuhan

        return view('pages.area.EditArea', compact('area'));
    }

    public function updateArea(Request $request, $id)
    {
        $request->validate([
            'area_name' => 'required|string|max:100',
            'description' => 'required|string|max:100',
        ]);

        $area = Area::where('identifiers', $id)->firstOrFail();
        try {
            db::beginTransaction();

            $area->area_name = $request->input('area_name');
            $area->description = $request->input('description');

            $area->save();

            db::commit();
            Alert::success('Success', 'Area Updated');
            return redirect()->route('area.view');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        $data = Area::findOrFail($id);


        $data->delete();


        Alert::success('Success', 'Area Deleted');


        return redirect()->route('area.view');
    }
}