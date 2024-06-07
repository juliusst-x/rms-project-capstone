<?php

namespace App\Http\Controllers;

use App\Models\Concern_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class concernController extends Controller
{
    public function adminIndex()
    {

        // $items = Concern_report::where('user_id', Auth::user()->id)->get();
        // $items = Concern_report::all();

        $items = DB::table('concern_reports')
            ->join('users', 'concern_reports.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'concern_reports.*')
            ->whereNull('deleted_at')
            ->get();
        return view('pages.admin.concern.concern', [
            'items' => $items
        ]);

    }

    public function concernForm()
    {
        $user = Auth::user()->resident; // Ubah cara Anda mendapatkan data pengguna
        return view('pages.masyarakat.concernForm', compact('user'));
    }

    public function concernDetail($id)
    {
        // $item = Concern_report::where('identifiers', $id)->firstOrFail();

        $item = DB::table('concern_reports')
            ->join('users', 'concern_reports.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'concern_reports.*')
            ->where('concern_reports.identifiers', $id)
            ->first();
        $response = DB::table('responses')->
            join('concern_reports', 'concern_reports.id', 'responses.concern_id')
            ->select('responses.*')
            ->orderBy('responses.created_at','desc')
            ->where('concern_reports.identifiers', $id)
            ->first();
        return view('pages.admin.concern.detail', compact('item', 'response'));
    }

    public function userIndex()
    {

        // $items = Concern_report::where('user_id', Auth::user()->id)->get();
        // $items = Concern_report::all();
        $items = DB::table('concern_reports')
            ->join('users', 'concern_reports.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'concern_reports.*')
            ->where('users.id', Auth::user()->id)
            ->whereNull('deleted_at')
            ->get();

        return view('pages.masyarakat.concernUser', [
            'items' => $items
        ]);

    }

    public function userconcernDetail($id)
    {

        $item = DB::table('concern_reports')
            ->join('users', 'concern_reports.user_id', '=', 'users.id')
            ->select('users.name', 'users.phone', 'concern_reports.*')
            ->where('concern_reports.identifiers', $id)
            ->first();
        $response = DB::table('responses')->
        join('concern_reports', 'concern_reports.id', 'responses.concern_id')
        ->select('responses.*')
        ->orderBy('responses.created_at','desc')
        ->where('concern_reports.identifiers', $id)
        ->first();
        return view('pages.masyarakat.detail', compact('item', 'response'));
    }
    public function deleteConcern($id)
    {
        try {
            DB::beginTransaction();
            $concern = Concern_report::where('identifiers', $id)->first();
            $concern->delete();
            DB::commit();
            Alert::success('Success', 'Concern Deleted');
            return redirect()->route('admin-concern');
        } catch (\Throwable $th) {
            Alert::Error('Error', $th->getMessage());
            return redirect()->route('admin-concern');
        }

    }


    // public function deleteConcern(Request $request)
    // {
    //    Concern_report::findOrFail($request->id)->delete();




    //    return redirect()->route('admin.pengaduan');


    // }
}