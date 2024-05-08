<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Tanggapan;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Trash;
use Carbon\Carbon;

class TrashController extends Controller
{
    public function index()
    {
        $trashs = Trash::all();
        return view('pages.admin.trash.index', compact("trashs"));
    }

    public function waste()
    {
        $trashs = Trash::all();
        return view('pages.admin.trash.waste', compact("trashs"));
    }


    public function simpanData()
    {
        $trashLevel = request()->trashLevel;
        if ($trashLevel > 70) {
            $status = "Sedang menunggu pickup";
        } else {
            $status = "Aman";
        }
        Trash::where('area_id', request()->area_id)
            ->update([
                'trash_level' => $trashLevel,
                'status' => $status,
                'Updated_at' => Carbon::now()
            ]);
        $items = Trash::all();
        return view('pages.admin.trash.index', compact("items"));
    }
}
