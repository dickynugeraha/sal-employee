<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Position;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with("position")->get();
        $positions = Position::all();

        return view("employee.index", compact("employees", "positions"));
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
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $image = $request->file('photo');
        $image_name = time() . "." . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/photo');
        $image->move($destinationPath, $image_name);

        Employee::create([
            "nik" => $request->nik,
            "name" => $request->name,
            "email" => $request->email,
            "address" => $request->address,
            "age" => $request->age,
            "bank" => $request->bank,
            "no_rekening" => $request->no_rekening,
            "basic_salary" => $request->basic_salary,
            "photo" => $image_name,
            "position_id" => $request->position_id,
        ]);

        return redirect()->back()->with("alert", "Successfully add employee !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee = Employee::where("id", "=", $request->employee_id);
        $image = $request->file('photo');
        $image_name = "";

        if ($request->photo != null) {
            $image_name = time() . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/photo');
            $image->move($destinationPath, $image_name);

            $old_image = $employee->first()->photo;
            $image = public_path('uploads/photo/') . $old_image;
            if (file_exists($image)) @unlink($image);
        } else {
            $image_name = $employee->first()->photo;
        }

        Employee::where("id", "=", $request->employee_id)->update([
            "nik" => $request->nik,
            "name" => $request->name,
            "email" => $request->email,
            "address" => $request->address,
            "age" => $request->age,
            "bank" => $request->bank,
            "no_rekening" => $request->no_rekening,
            "basic_salary" => $request->basic_salary,
            "photo" => $image_name,
            "position_id" => $request->position_id,
        ]);

        return redirect()->back()->with("alert", "Successfully updated employee !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $employee = Employee::where("id", "=", $id);

        $fileName = $employee->first()->photo;

        $image = public_path('uploads/photo/') . $fileName;

        if (file_exists($image)) @unlink($image);

        $employee->delete();
        return redirect()->back()->with('alert', 'Successfully delete employee!');
    }
}
