<?php

namespace App\Http\Controllers;

use App\Models\Area;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Trash;
use Carbon\Carbon;
use App\Models\User;
use App\Notifications\emailNotifTrash;
use Illuminate\Support\Facades\Notification;

class TrashController extends Controller
{
    public function index()
    {
        $trashs = Trash::all();
        return view('pages.admin.trash.index', compact("trashs"));
    }
    public function add_trash_page()
    {
        $areas = Area::all();
        return view('pages.admin.trash.addTrash', compact('areas'));
    }

    public function waste()
    {
        $trashs = Trash::all();

        return view('pages.admin.trash.waste', compact("trashs"));
    }
    public function waste_level()
    {
        $trashs = Trash::with('area')->get();
        return response()->json(['trashs' => $trashs]);
    }
    public function waste_status()
    {
        $trashs = Trash::all();
        return view('pages.admin.trash.trash_status', compact("trashs"));
    }

    public function simpanData($trashLevel, $id)
    {
        $trash = Trash::where('id', $id)->first();

        $area = Area::where('id', $trash->area_id)->first();
        $date1 = new DateTime($trash->Notif_at);
        $date2 = now();
        DB::beginTransaction();
        try {
            if ($trashLevel >= $trash->threshold) {
                $status = "Wait for pick up the trash";
                $trash->update([
                    'trash_level' => $trashLevel,
                    'status' => $status,
                    'Updated_at' => Carbon::now(),
                ]);
                if ($trash->Notif_at == null) {
                    $trash->update([
                        'Notif_at' => Carbon::now(),
                    ]);
                    $users = User::where('level', 'TRASHMAN')->get();
                    $details = [
                        'greeting' => 'Alert',
                        'body' => 'Please Pick Up the Trash at ' . $area->area_name,
                        'lastline' => 'Auto generated message'
                    ];
                    Notification::send($users, new emailNotifTrash($details));
                } elseif ($date2->diff($date1)->h >= 70) {
                    $trash->update([
                        'Notif_at' => null,
                    ]);
                }
            } else {
                $status = "Empty";
                $trash->update([
                    'trash_level' => $trashLevel,
                    'status' => $status,
                    'Updated_at' => Carbon::now(),
                    'Notif_at' => null,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
        }



        // $users = User::all();

        // $details = [
        //     'greeting' => 'Alert',
        //     'body' => 'Please Pick Up the Trash',
        //     'lastline' => 'last line'
        // ];
        // Notification::send($users, new emailNotifTrash($details));
    }

    public function addTrash(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'area_id' => 'required|string|max:100',
            'Threshold' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $trash = new Trash();
            $trash->area_id = $request->input('area_id');
            $trash->Threshold = $request->input('Threshold');

            // Menyimpan data ke database
            $trash->save();
            db::commit();

            Alert::success('Success', 'Trash Added');

            // Redirect ke halaman index
            return redirect()->route('trash.index');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());

            // Redirect ke halaman index
            return redirect()->route('trash.index');
        }
    }
    public function edit_trash_page($identifiers)
    {
        $trash = Trash::where('identifiers', $identifiers)->first();
        $areas = Area::all();
        return view('pages.admin.trash.editTrash', compact('trash', 'areas'));
    }
    public function edit_trash(Request $request, $identifiers)
    {
        $request->validate([
            'area_id' => 'required|string|max:100',
            'Threshold' => 'required',
        ]);
        $trash = Trash::where('identifiers', $identifiers)->firstOrFail();
        DB::beginTransaction();
        try {
            $trash->area_id = $request->area_id;
            $trash->Threshold = $request->Threshold;
            $trash->save();
            DB::commit();
            Alert::success('Success', 'Trash Updated');
            return redirect()->route('trash.index')->with('success', 'Trash updated successfully!');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            db::rollBack();
            return redirect()->route('trash.index');
        }
    }

    public function deleteTrash($id)
    {
        try {
            db::beginTransaction();

            $data = Trash::where('identifiers', $id)->firstOrFail();

            $data->delete();

            db::commit();
            Alert::success('Success', 'Trash Data Deleted');

            return redirect()->route('trash.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to Delete Trash Data');
            db::rollBack();
            return redirect()->route('trash.index');
        }
    }
}
