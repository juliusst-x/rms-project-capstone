<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data dari tabel Concern_report
        $items = Concern_report::all();
    
        // Mengambil data User yang sesuai dengan nilai user_id di Concern_report menggunakan join
        $users = DB::table('concern_reports')
                    ->join('users', 'concern_reports.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->get();
    
        return view('pages.admin.pengaduan.index', [
            'items' => $items,
            'users' => $users
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validatedData = $request->validate([
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming you want to allow only image files with max size of 2MB
        ]);

        // Process the submitted data
        // Save the description to the database
        // Save the image to storage

        // Redirect back with a success message or any other action you want to take
        return redirect()->back()->with('success', 'Report submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Concern_report::with([
            'details', 'user'
        ])->findOrFail($id);

        $tangap = Concern_report::where('id',$id)->first();

        $itemWithUser = Concern_report::join('users', 'concern_reports.user_id', '=', 'users.id')
        ->select('concern_reports.*', 'users.name as user_name')
        ->findOrFail($id);


        return view('pages.admin.pengaduan.detail',[
            'item' => $item,
            'tangap' => $tangap,
            'itemWithUser'=> $itemWithUser
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


        // $status->update($data);
        return redirect('admin/pengaduans');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengaduan = Concern_report::find($id);
        $pengaduan->delete();

        Alert::success('Success', 'Report Already Deleted');
        return redirect('admin/pengaduans');
    }
}
