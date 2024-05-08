<?php

namespace App\Http\Controllers;

use App\Models\Concern_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class concernController extends Controller
{
    public function adminIndex()
    {

        // $items = Concern_report::where('user_id', Auth::user()->id)->get();
        $items = Concern_report::all();

        return view('pages.admin.concern.concern', [
            'items' => $items
        ]);

    }
    public function concernDetail($id)
    {
        // $item = Concern_report::where('identifiers', $id)->firstOrFail();

        $item = DB::table('concern_reports')
            ->join('users', 'concern_reports.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'concern_reports.*')
            ->first();
        return view('pages.admin.concern.detail', compact('item'));
    }

    public function userIndex()
    {

        // $items = Concern_report::where('user_id', Auth::user()->id)->get();
        $items = Concern_report::all();

        return view('pages.masyarakat.concernUser', [
            'items' => $items
        ]);

    }
}