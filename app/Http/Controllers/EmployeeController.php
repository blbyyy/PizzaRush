<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\User;
use App\Models\Announcement;

use View;
use DB;
use File;
use Auth;

use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listofemployee()
    {
         $employee = DB::table('employees')
         ->join('users','users.id','employees.user_id')
         ->select('employees.*','users.*')
         ->get();
         return View::make('layouts.about',compact('employee'));
    }
    public function announcement()
    {
        $announcement = Announcement::all();
        return View::make('employee.announcement',compact('announcement'));
    }
    public function index()
    {
        //
        return View::make('employee.index');
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
            $users->role = 'employee';
            $users->save();
            $last = DB::getPdo()->lastInsertId();

            $employees = new Employee();
            $employees->name = $request->name;
            $employees->gender = $request->gender;
            $employees->phone = $request->phone;
            $employees->address = $request->address;
            $employees->birthdate = $request->birthdate;
            $employees->user_id = $last;

            $files = $request->file('image');
            $employees->image = 'images/'.time().'-'.$files->getClientOriginalName();

            $employees->save();

            $data = array('status' => 'saved');
            Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

            return response()->json(["success" => "Employee Created Successfully.", "Employee" => $employees, "status" => 200]);
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
        $employee = Employee::where('user_id',Auth::id())->first();
        return View::make('employee.profile',compact('employee'));
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
        $employee = Employee::Find($id);
        return response()->json($employee);
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
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->birthdate = $request->birthdate;
        $employee->save();

        return response()->json($employee);
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

        $customers = Employee::where('id', $id)->first();

        // dd($customers);

        $customer = User::where('id', $customers->user_id)->first();
        // dd($customer);

        $customer->delete();

        $data = array('success' =>'deleted','code'=>'200');
        return response()->json($data);
    }

    public function getEmployeeAll(Request $request)
    {
        //if ($request->ajax()){
            $employees = Employee::join('users', 'users.id', 'employees.user_id')->select('employees.*','users.email')->orderBy('id')->get();
            return response()->json($employees);
         //}
    }

    public function editprofile($id)
    {
        //
        $employee = Employee::where('user_id',Auth::id())->first();
        // dd($employee);
        return View::make('employee.edit-profile',compact('employee'));
    }

    public function updateprofile(Request $request, $id)
    {
        //
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->gender = $request->gender;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->birthdate = $request->birthdate;

        $files = $request->file('image');
        $employee->image = 'images/'.time().'-'.$files->getClientOriginalName();

        $employee->save();

        Storage::put('public/images/'.time().'-'.$files->getClientOriginalName(), file_get_contents($files));

        return redirect()->back()->with('success', 'EMPLOYEE UPDATED!');
    }

}
