<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Concern_report;
use App\Models\User;
use App\Models\Staff;
use App\Models\Group;
use App\Models\Resident;
use App\Models\Response;
use App\Models\Early_warning;
use App\Models\Trash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function __invoke()
    {
        // Your code here if necessary
    }

    public function laporan()
    {
        $pengaduan = Concern_report::all();

        // Get the counts and statuses
        $data = [
            'pengaduan' => Concern_report::count(),
            'user' => User::where('roles', '=', 'USER')->count(),
            'staff' => User::where('roles', '=', 'STAFF')->count(),
            'admin' => User::where('roles', '=', 'ADMIN')->count(),
            'tanggapan' => Response::count(),
            'pending' => Concern_report::where('status', 'Pending')->count(),
            'process' => Concern_report::where('status', 'In Process')->count(),
            'success' => Concern_report::where('status', 'Done')->count(),
            'water_level' => Early_warning::latest('created_at')->pluck('status')->first(),
            'trash_level' => Trash::latest('created_at')->pluck('status')->first(),
        ];

        return view('pages.admin.laporan', [
            'pengaduan' => $pengaduan,
            'data' => $data
        ]);
    }

    public function cetak()
    {
        $pengaduan = Concern_report::all();

        // Get the counts and statuses
        $data = [
            'pengaduan' => Concern_report::count(),
            'user' => User::where('roles', '=', 'USER')->count(),
            'staff' => User::where('roles', '=', 'STAFF')->count(),
            'admin' => User::where('roles', '=', 'ADMIN')->count(),
            'tanggapan' => Response::count(),
            'pending' => Concern_report::where('status', 'Pending')->count(),
            'process' => Concern_report::where('status', 'In Process')->count(),
            'success' => Concern_report::where('status', 'Done')->count(),
            'water_level' => Early_warning::latest('created_at')->pluck('status')->first(),
            'trash_level' => Trash::latest('created_at')->pluck('status')->first(),
        ];

        $pdf = PDF::loadview('pages.admin.pengaduan', [
            'pengaduan' => $pengaduan,
            'data' => $data
        ]);
        return $pdf->download('concern-report.pdf');
    }

    public function pdf($id)
    {
        $pengaduan = Concern_report::with('user')->findOrFail($id);
    
        // Get the counts and statuses
        $data = [
            'pengaduan_count' => Concern_report::count(),
            'user_count' => User::where('roles', '=', 'USER')->count(),
            'staff_count' => User::where('roles', '=', 'STAFF')->count(),
            'admin_count' => User::where('roles', '=', 'ADMIN')->count(),
            'tanggapan_count' => Response::count(),
            'pending_count' => Concern_report::where('status', 'Pending')->count(),
            'process_count' => Concern_report::where('status', 'In Process')->count(),
            'success_count' => Concern_report::where('status', 'Done')->count(),
            'water_level' => Early_warning::latest('created_at')->pluck('status')->first(),
            'trash_level' => Trash::latest('created_at')->pluck('status')->first(),
        ];
    
        $pdf = PDF::loadview('pages.admin.respondId', compact('pengaduan', 'data'))->setPaper('a4');
        return $pdf->download('report-detail.pdf');
    }
    
    // Other methods...
}
