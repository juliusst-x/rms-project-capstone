<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Notifications\emailNotifTrash;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
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
    public function water_level()
    {

        $waterLevels = Early_warning::with('area')->get();
        return response()->json(['waterLevels' => $waterLevels]);
    }




    public function simpanData($waterLevel, $id)
    {
        $water = Early_warning::where('id', $id)->first();
        $area = Area::where('id', $water->area_id)->first();
        $date1 = new DateTime($water->Notif_at);
        $date2 = now();

        DB::beginTransaction();
        try {
            if ($water->threshold-$waterLevel >= $water->threshold-3) {
                $status = "Potential Flood";
                $water->update([
                    'water_level' => $water->threshold-$waterLevel,
                    'status' => $status,
                    'updated_at' => Carbon::now(),
                ]);
                if ($water->Notif_at == null) {
                    $water->update([
                        'Notif_at' => Carbon::now(),
                    ]);
                    $users = User::where('level', 'RESIDENT')->get();
                    $details = [
                        'greeting' => 'Alert',
                        'body' => 'Potential Flood at ' . $area->area_name,
                        'lastline' => 'Auto generated message'
                    ];
                    Notification::send($users, new emailNotifTrash($details));
                } elseif ($date2->diff($date1)->h >= 6) {
                    $water->update([
                        'Notif_at' => null,
                    ]);
                }
            } else {
                $status = "Safe";
                if ($date2->diff($date1)->m >= 10) {
                    $water->update([
                        'Notif_at' => null,
                    ]);
                }
                $water->update([
                    'water_level' => $water->threshold-$waterLevel,
                    'status' => $status,
                    'updated_at' => Carbon::now(),
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function add_water_page()
    {
        $areas = Area::all();
        return view('pages.admin.water.addWater', compact('areas'));
    }

    public function addWater(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'area_id' => 'required|string|max:100',
            'Threshold' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $water = new Early_warning();
            $water->area_id = $request->input('area_id');
            $water->Threshold = $request->input('Threshold');

            // Menyimpan data ke database
            $water->save();
            db::commit();

            Alert::success('Success', 'Water Added');

            // Redirect ke halaman index
            return redirect()->route('water.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());

            // Redirect ke halaman index
            return redirect()->route('water.index');
        }
    }
    public function edit_water_page($identifiers)
    {
        $water = Early_warning::where('identifiers', $identifiers)->first();
        $areas = Area::all();
        return view('pages.admin.water.editWater', compact('water', 'areas'));
    }
    public function edit_water(Request $request, $identifiers)
    {
        $request->validate([
            'area_id' => 'required|string|max:100',
            'Threshold' => 'required',
        ]);
        $water = Early_warning::where('identifiers', $identifiers)->firstOrFail();
        DB::beginTransaction();
        try {
            $water->area_id = $request->area_id;
            $water->Threshold = $request->Threshold;
            $water->save();
            DB::commit();
            Alert::success('Success', 'Water Detector Updated');
            return redirect()->route('water.index')->with('success', 'Water updated successfully!');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            db::rollBack();
            return redirect()->route('water.index');
        }

    }

    public function deletewater($id)
    {
        try {
            db::beginTransaction();

            $data = Early_warning::where('identifiers', $id)->firstOrFail();

            $data->delete();

            db::commit();
            Alert::success('Success', 'water Data Deleted');

            return redirect()->route('water.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to Delete water Data');
            db::rollBack();
            return redirect()->route('water.index');
        }

    }
}