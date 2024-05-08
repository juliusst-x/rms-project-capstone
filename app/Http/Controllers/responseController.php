<?php

namespace App\Http\Controllers;

use App\Models\Concern_report;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class responseController extends Controller
{
    public function index($id)
    {
        $concern = Concern_report::where("identifiers", $id)->firstorfail();
        return view('pages.admin.responses.addResponse', compact('concern'));
    }
    public function addResponse(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:255',
            'status' => 'required|string|max:500',
        ]);

        try {
            db::beginTransaction();

            DB::table('concern_reports')->where('identifiers', $request->id)->update([
                'status' => $request->status,
            ]);
            $conId = Concern_report::where('identifiers', $request->id)->firstorfail();
            $response = Response::create([
                'concern_id' => $conId->id,
                'response' => $request->response,
                'user_id' => Auth::user()->id,
            ]);

            $response->save();
            db::commit();

            Alert::success('Success', 'Successfully Responded Concern!');
            return redirect(route('admin-concern'));
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }
}