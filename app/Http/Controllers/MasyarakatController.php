<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->resident; // Ubah cara Anda mendapatkan data pengguna
        return view('pages.masyarakat.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.masyarakat.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'image' => 'required',
        ]);

        $id = Auth::user()->id;
        $name = Auth::user()->name;

        $data = $request->all();
        $data['user_id'] = $id;
        $data['name'] = $name;
        $data['image'] = $request->file('image')->store('assets/laporan', 'public');

        Alert::success('Success', 'Report Send!');
        Concern_report::create($data);
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function lihat()
    {

        $items = Concern_report::where('user_id',Auth);

        return view('pages.masyarakat.concernUser', [
            'items' => $items
        ]);

    }

    public function show($id)
    {
        $item = Concern_report::with([
            'details',
            'user'
        ])->findOrFail($id);

        $tangap = Concern_report::where('id', $id)->first();

        return view('pages.masyarakat.show', [
            'item' => $item,
            'tangap' => $tangap
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}