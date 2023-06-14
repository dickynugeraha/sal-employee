<?php

use App\Http\Controllers\SalaryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/salaries", [SalaryController::class, "index"]);
Route::post("/salary", [SalaryController::class, "store"]);
Route::post("/salary/update", [SalaryController::class, "update"]);
Route::get("/salary/{id}/delete", [SalaryController::class, "destroy"]);

Route::get("/employees", [EmployeeController::class, "index"]);
Route::post("/employee", [EmployeeController::class, "store"]);
Route::post("/employee/update", [EmployeeController::class, "update"]);
Route::get("/employee/{id}/delete", [EmployeeController::class, "destroy"]);

Route::get("/positions", [PositionController::class, "index"]);
Route::post("/position", [PositionController::class, "store"]);
Route::post("/position/update", [PositionController::class, "update"]);
Route::get("/position/{id}/delete", [PositionController::class, "destroy"]);
