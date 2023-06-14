<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Employee;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salaries = Salary::all();
        $employees = Employee::with("position")->get();

        return view("salary.index", compact("salaries", "employees"));
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
     * @param  \App\Http\Requests\StoreSalaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaryRequest $request)
    {
        $employee = Employee::where("id", "=", $request->employee_id)->first();

        $totalSalary =
            $employee->basic_salary +
            ($employee->basic_salary * $employee->position->bonus) -
            ($employee->basic_salary * 0.05);

        Salary::create([
            "employee_id" => $request->employee_id,
            "position_title" => $employee->position->title,
            "position_bonus" => $employee->position->bonus,
            "month" => $request->month,
            "year" => $request->year,
            "total_salary" => $totalSalary,
        ]);

        return redirect()->back()->with("alert", "Successfully add salary !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaryRequest  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salary::where("id", "=", $id)->delete();

        return redirect()->back()->with("alert", "Successfully delete salary !");
    }
}
