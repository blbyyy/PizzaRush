<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Voucher;
use App\Models\Customer;
use App\Models\Voucherlines;
use View;
use Auth;
use Redirect;
use DB;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vouchers = Voucher::where('status','Available')->get();
        $vouchers = Voucher::get();
        // dd($vouchers);
        return View::make('Voucher-Index.index', compact('vouchers'));
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
        // $input = $request->all();
        // $voucher = Voucher::find($id);
        $customer =  Customer::where('user_id',Auth::id())->first();
        // dd($input);
        // $users = User::where('id',$employee->user_id)
        // $users = User::find($employee->id);
        // $users->role = $request->role;
        // $users->save();

        $voucherlines = new Voucherlines();
        $voucherlines->customer_id = $customer->id;
        $voucherlines->voucher_id = $groom->id;
        $voucherlines->save();

        return View::make('Voucher-Index.index');

        // return redirect()->route('Voucher-Index.index')->with('success','VOUCHER CLAIMED SUCCESSFULLY!');

        // return Redirect::to('index')->with('success','EMPLOYEE ROLE UPDATED!');
        // return redirect()->back()->with('success', 'EMPLOYEE UPDATED!');
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
    }

    public function voucherstore(Request $request)
    {
       
        $customer =  Customer::where('user_id',Auth::id())->first();
        
        $voucherlines = new Voucherlines();
        $voucherlines->customer_id = $customer->id;
        $voucherlines->voucher_id = $request->voucher_id;
        $voucherlines->status = 'Not Use';

        $voucherlines->save();

        $lastid = DB::getPdo()->lastInsertId();

        $vouchers = DB::table('vouchers')
        ->join('voucherlines','vouchers.id','voucherlines.voucher_id')
        ->join('customers','customers.id','voucherlines.customer_id')
        ->join('users','users.id','customers.user_id')
        ->select('vouchers.value','vouchers.name','vouchers.description','vouchers.image','vouchers.limit','voucherlines.voucher_id')
        ->orderBy('voucherlines.voucher_id','DESC')
        ->where('user_id',Auth::id())
        ->first();

        DB::table('vouchers')
        ->where('vouchers.id',$vouchers->voucher_id)
        ->update([
            'status' => 'Claimed',
        ]);

        return redirect()->back()->with('Success', ' Voucher Claimed Successfully!');
    }
}
