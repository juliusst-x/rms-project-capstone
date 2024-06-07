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
use App\Models\Early_warning;
use App\Models\Trash;
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
        $userId = Auth::user()->id;

        return view('pages.masyarakat.index', [
            'pengaduan' => Concern_report::where('user_id', $userId)->count(),
            'pending' => Concern_report::where('user_id', $userId)->where('status', 'Pending')->count(),
            'process' => Concern_report::where('user_id', $userId)->where('status', 'In Process')->count(),
            'success' => Concern_report::where('user_id', $userId)->where('status', 'Done')->count(),
            'water_level' => Early_warning::latest('created_at')->pluck('status')->first(),
            'trash_level' => Trash::latest('created_at')->pluck('status')->first()
        ]);
    }

    // public function concernForm()
    // {
    //     $user = Auth::user()->resident; // Ubah cara Anda mendapatkan data pengguna
    //     return view('pages.masyarakat.concernForm', compact('user'));
    // }

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
        // Validate the incoming request data
        $request->validate([
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Assuming you want to allow only image files
        ]);

        // Check if the uploaded image exceeds the maximum allowed size (2MB)
        if ($request->hasFile('image')) {
            $maxSize = 2048; // in kilobytes
            $uploadedFileSize = $request->file('image')->getSize(); // in bytes
            $maxSizeInBytes = $maxSize * 1024; // convert kilobytes to bytes

            if ($uploadedFileSize > $maxSizeInBytes) {
                // Display a SweetAlert error message for image size
                Alert::error('Error', 'The image may not be greater than 2048 kilobytes.')->persistent(true);
                
                // Redirect back
                return redirect()->back();
            }
        }

        // Retrieve the last report status
        $lastReport = Concern_report::where('user_id', auth()->id())->latest()->first();

        // Check if the last report exists and its status is not 'Done'
        if ($lastReport && $lastReport->status !== 'Done') {
            // Display a SweetAlert error message
            Alert::error('Error', 'You cannot submit a new report until your previous report is resolved.')->persistent(true);
            
            // Redirect back
            return redirect()->back();
        }

        // Create a new report
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['image'] = $request->file('image')->store('assets/laporan', 'public');
        
        // Save the report data
        Concern_report::create($data);

        // Display a SweetAlert success message
        Alert::success('Success', 'Report Sent!');

        // Redirect back
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

        $items = Concern_report::where('user_id', Auth);

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
