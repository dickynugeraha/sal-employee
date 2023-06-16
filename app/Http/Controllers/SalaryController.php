<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salaries = Salary::all();
        $month = $request->get("month");
        $year = $request->get("year");

        if ($month !== null && $year !== null) {
            $salaries = Salary::where("month", "=", $month)
                ->where("year", "=", $year);
        }

        $employees = Employee::with("position")->get();

        return view("salary.index", compact("salaries", "employees"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPdf(Request $request)
    {
        $salaries = Salary::all();

        $month = $request->get("month");
        $year = $request->get("year");

        if ($month && $year) {
            $salaries = Salary::where("month", "=", $month)->where("year", "=", $year)->get();

            if (count($salaries) == 0) {
                return redirect()->back()->with("alert", "No data, cannot export pdf!");
            }
        }

        $pdf = Pdf::loadView("salary.data", compact("salaries", "month", "year"));

        return $pdf->download("transaction_salaries.pdf");
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

        $totalSalary = $employee->basic_salary +
            ($employee->basic_salary * $employee->position->bonus);
        $totalSalary -= ($totalSalary * 0.05);

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
