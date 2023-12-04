<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PizzaCrust;
use View;
use DB;
use File;

class PizzaCrustController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPizzaCrustAll(Request $request)
     {
        //if ($request->ajax()){
            $pizzacrust = PizzaCrust::orderBy('id')->get();
            return response()->json($pizzacrust);
         //}
    }

    public function index()
    {
        return View::make('pizzacrust.index');
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
        $pizzacrust = new PizzaCrust();
        $pizzacrust->name = $request->name;
        $pizzacrust->description = $request->description;
        $pizzacrust->fee = $request->fee;
    
        $files = $request->file('image');
        $pizzacrust->image = '/images'.time().'-'.$files->getClientOriginalName();

        $pizzacrust->save();

        $data = array('status' => 'saved');
        Storage::put('public/images'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "Pizza Crust Created Successfully.", "PizzaCrust" => $pizzacrust, "status" => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizzacrust = PizzaCrust::Find($id);
        return response()->json($pizzacrust);
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
        $pizzacrust = PizzaCrust::find($id);
        $pizzacrust->name = $request->name;
        $pizzacrust->description = $request->description;
        $pizzacrust->fee = $request->fee;
        $pizzacrust->save();

        return response()->json($pizzacrust);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizzacrust = PizzaCrust::findOrFail($id);

        if (File::exists("storage/".$pizzacrust->image)) {
            File::delete("storage/".$pizzacrust->image);
        }

        $pizzacrust->delete();

        $data = array('success' =>'Pizza Crust Successfully Deleted','code'=>'200');
        return response()->json($data);
    }
}
