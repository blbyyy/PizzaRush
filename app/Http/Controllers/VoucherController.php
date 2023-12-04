<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Voucher;
// use App\Models\Vstock;
use View;
use DB;
use File;
use Auth;

use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voucherlist()
    {
        $vouchers = DB::table('vouchers')
        ->join('voucherlines','vouchers.id','voucherlines.voucher_id')
        ->join('customers','customers.id','voucherlines.customer_id')
        ->join('users','users.id','customers.user_id')
        ->select('voucherlines.status','vouchers.value','vouchers.name','vouchers.description','vouchers.image','vouchers.limit')
        ->orderBy('voucherlines.id','DESC')
        ->where('user_id',Auth::id())
        ->get();
        // dd($vouchers);
        return View::make('voucher.voucherlist',compact('vouchers'));
    }
    public function index()
    {
        //
        return View::make('voucher.index');
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
            $vouchers = new Voucher();
            $vouchers->name = $request->name;
            $vouchers->description = $request->description;
            $vouchers->value = $request->value;
            $vouchers->limit = $request->limit;
            $vouchers->status = 'Available';

            $files = $request->file('image');
            $vouchers->image = 'images/'.time().'-'.$files->getClientOriginalName();

            $vouchers->save();

            $data = array('status' => 'saved');
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

            return response()->json(["success" => "Voucher Created Successfully.", "Voucher" => $vouchers, "status" => 200]);
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
        //
        $voucher = Voucher::Find($id);
        return response()->json($voucher);
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
        $voucher = Voucher::find($id);
        $voucher->name = $request->name;
        $voucher->description = $request->description;
        $voucher->value = $request->value;
        $voucher->limit = $request->limit;
        $voucher->save();

        return response()->json($voucher);
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
        $voucher = Voucher::findOrFail($id);

        if (File::exists("storage/".$voucher->image)) {
            File::delete("storage/".$voucher->image);
        }

        $voucher->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function getVoucherAll(Request $request){
        //if ($request->ajax()){
            $vouchers = Voucher::orderBy('id')->get();
            return response()->json($vouchers);
         //}
    }
}
