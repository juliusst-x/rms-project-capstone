<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concern_report;
use App\Models\Early_warning;
use App\Models\Response;
use App\Models\Trash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        return view('pages.admin.dashboard',[
            'pengaduan' => Concern_report::count(),
            'user' => User::where('roles','=', 'USER')->count(),
            'staff' => User::where('roles', '=', 'STAFF')->count(),
            'admin' => User::where('roles', '=', 'ADMIN')->count(),
            'tanggapan' => Response::count(),
            'pending' => Concern_report::where('status', 'Belum di Proses')->count(),
            'process' => Concern_report::where('status', 'Sedang di Proses')->count(),
            'success' => Concern_report::where('status', 'Selesai')->count(),
            'water_level' => Early_warning::latest('created_at')->pluck('status')->first(),
            'trash_level' => Trash::latest('created_at')->pluck('status')->first(),
        ]);
    }
}