<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Announcement;

use Illuminate\Support\Facades\Storage;

use View;
use DB;
use File;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View::make('announcement.index');
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
        //
        $announce = new Announcement();
        $announce->title = $request->title;
        $announce->info = $request->info;
    
        $files = $request->file('image');
        $announce->image = '/images'.time().'-'.$files->getClientOriginalName();

        $announce->save();

        $data = array('status' => 'saved');
        Storage::put('public/images'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "Announcement Created Successfully.", "Announcement" => $announce, "status" => 200]);
    }
    public function store1(Request $request)
    {
        //
        $announce = new Announcement();
        $announce->title = $request->title;
        $announce->info = $request->info;
    
        $files = $request->file('image');
        $announce->image = '/images'.time().'-'.$files->getClientOriginalName();

        $announce->save();

        $data = array('status' => 'saved');
        Storage::put('public/images'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return redirect()->back()->with('success', 'Message Successfully Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $announce = Announcement::all();
        // dd($announce);
        return view('announcement.announcement', compact('announce'));
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
        $announce = Announcement::Find($id);
        return response()->json($announce);
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
        //
        $announce = Announcement::find($id);
        $announce->title = $request->title;
        $announce->info = $request->info;
        $announce->save();

        return response()->json($announce);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $announce = Announcement::findOrFail($id);

        if (File::exists("storage/".$announce->image)) {
            File::delete("storage/".$announce->image);
        }

        $announce->delete();

        $data = array('success' =>'Announcement Successfully Deleted','code'=>'200');
        return response()->json($data);
    }

    public function getAnnouncementAll(Request $request)
     {
        //if ($request->ajax()){
            $announce = Announcement::orderBy('id')->get();
            return response()->json($announce);
         //}
    }
}
