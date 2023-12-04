<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\User;

use View;
use DB;
use File;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View::make('customer.index');
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

            $users = new User();
            $users->email = $request->email;
            $users->password = bcrypt($request->password);
            $users->role = 'customer';
            $users->save();
            $last = DB::getPdo()->lastInsertId();

            $customers = new Customer();
            $customers->name = $request->name;
            $customers->gender = $request->gender;
            $customers->phone = $request->phone;
            $customers->address = $request->address;
            $customers->birthdate = $request->birthdate;
            $customers->user_id = $last;

            $customers->save();

            $data = array('status' => 'saved');

            return response()->json(["success" => "Customer Created Successfully.", "Customer" => $customers, "status" => 200]);

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
        $customer = Customer::where('user_id',Auth::id())->first();
        return View::make('customer.edit-profile',compact('customer'));
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
        $customer = Customer::Find($id);
        return response()->json($customer);
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

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->birthdate = $request->birthdate;
        $customer->save();

        return response()->json($customer);
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
        $customers = Customer::where('id', $id)->first();

        // dd($customers);

        $customer = User::where('id', $customers->user_id)->first();
        // dd($customer);

        $customer->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function getCustomerAll(Request $request)
    {
        //if ($request->ajax()){
            $customers = Customer::join('users', 'users.id', 'customers.user_id')->select('customers.*','users.email')->orderBy('id')->get();
            return response()->json($customers);
         //}
    }

    public function updateprofile(Request $request, $id)
    {
        //
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->birthdate = $request->birthdate;

        $customer->save();


        return redirect()->back()->with('success', 'CUSTOMER UPDATED!');
    }
}
