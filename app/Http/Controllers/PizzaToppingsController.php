<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PizzaToppings;
use View;
use DB;
use File;

class PizzaToppingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPizzaToppingsAll(Request $request)
     {
        //if ($request->ajax()){
            $pizzatoppings = PizzaToppings::orderBy('id')->get();
            return response()->json($pizzatoppings);
         //}
    }

    public function index()
    {
        return View::make('pizzatoppings.index');
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
        $pizzatoppings = new PizzaToppings();
        $pizzatoppings->name = $request->name;
        $pizzatoppings->description = $request->description;
        $pizzatoppings->fee = $request->fee;
    
        $files = $request->file('img_path');
        $pizzatoppings->img_path = '/images'.time().'-'.$files->getClientOriginalName();

        $pizzatoppings->save();

        $data = array('status' => 'saved');
        Storage::put('public/images'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return response()->json(["success" => "Pizza Toppings Created Successfully.", "PizzaToppings" => $pizzatoppings, "status" => 200]);
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
        $pizzatoppings = PizzaToppings::Find($id);
        return response()->json($pizzatoppings);
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
        $pizzatoppings = PizzaToppings::find($id);
        $pizzatoppings->name = $request->name;
        $pizzatoppings->description = $request->description;
        $pizzatoppings->fee = $request->fee;
        $pizzatoppings->save();

        return response()->json($pizzatoppings);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizzatoppings = PizzaToppings::findOrFail($id);

        if (File::exists("storage/".$pizzatoppings->img_path)) {
            File::delete("storage/".$pizzatoppings->img_path);
        }

        $pizzatoppings->delete();

        $data = array('success' =>'Pizza Toppings Successfully Deleted','code'=>'200');
        return response()->json($data);
    }
}
