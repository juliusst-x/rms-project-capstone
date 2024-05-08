<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Early_warning;
use Carbon\Carbon;

class FloodController extends Controller
{

    public function index()
    {

        $waterLevels = Early_warning::all();
        // dd($waterLevels);
        return view('pages.admin.water.index', compact("waterLevels"));
    }

    public function floodWarning()
    {

        $waterLevels = Early_warning::all();
        // dd($waterLevels);
        return view('pages.admin.water.floodWarning', compact("waterLevels"));
    }
  
    public function simpanData()
    {
        $waterLevel = request()->waterLevel;
        if ($waterLevel > 20) {
            $status = "Tidak Aman";
        } else {
            $status = "Aman";
        }
        Early_warning::where('area_id', request()->area_id)
            ->update([
                'water_level' => $waterLevel,
                'status' => $status,
                'Updated_at' => Carbon::now()
            ]);
    }
}
