<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SecurityController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\IncomeCardController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\FeedbackController;


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
// Route::any('/{any}', 'FrontendController@app')->where('any', '^(?!api).*$');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('home');
});

Route::get('/security/new', [SecurityController::class, 'create'])->name('security-new');
Route::get('/security/edit', [SecurityController::class, 'edit'])->name('security-edit');
Route::post('/security/update/{id}', [SecurityController::class, 'edit'])->name('security-update');
Route::post('/security/store', [SecurityController::class, 'store'])->name('security-store');
Route::get('/security/report/{id}', [SecurityController::class, 'report'])->name('security-report-show');
Route::get('/security/report', [SecurityController::class, 'report_post'])->name('security-report');
Route::post('/security/report', [SecurityController::class, 'report_post'])->name('security-report-post');
Route::post('/security/autoinsert', [SecurityController::class, 'autoinsert']);
Route::get('/security/autoinsert', [SecurityController::class, 'autoinsert']);


Route::get('/visitor/new', [VisitorController::class, 'create'])->name('visitor-new');
Route::post('/visitor/submit', [VisitorController::class, 'store'])->name('visitor-add-form');
Route::get('/visitor/index', [VisitorController::class, 'index'])->name('visitor-index');
Route::get('/visitor/print/{id}', [VisitorController::class, 'print'])->name('visitor-print');
Route::post('/visitor/exit', [VisitorController::class, 'exit'])->name('visitor-exit');
Route::post('/visitor/autoinsert', [VisitorController::class, 'autoinsert']);


Route::get('/car/new', [CarController::class, 'create'])->name('car-new');
Route::post('/car/submit', [CarController::class, 'store'])->name('car-add-form');
Route::get('/car/index', [CarController::class, 'index'])->name('car-index');
Route::get('/car/print/{id}', [CarController::class, 'print'])->name('car-print');
Route::post('/car/exit', [CarController::class, 'exit'])->name('car-exit');
Route::post('/car/autoinsert', [CarController::class, 'autoinsert']);


Route::post('/employee/autoinsert', [EmployeeController::class, 'autoinsert']);

Route::get('/card/index', [CardController::class, 'index'])->name('card-index');
Route::get('/card/create', [CardController::class, 'create'])->name('card-create');
Route::post('/card/store', [CardController::class, 'store'])->name('card-store');
Route::post('/card/destroy/{id}', [CardController::class, 'destroy'])->name('card-destroy');

Route::get('/incomecard/index', [IncomeCardController::class, 'index'])->name('incomecard-index');
Route::get('/card/createemployee', [IncomeCardController::class, 'createEmployee'])->name('card-create-employee');
Route::post('/card/storeemployee', [IncomeCardController::class, 'storeEmployee'])->name('card-store-employee');
Route::post('/incomecard/update/{id}', [IncomeCardController::class, 'update'])->name('incomecard-update');

Route::get('/fault/new', [FaultController::class, 'create'])->name('fault-new');
Route::post('/fault/submit', [FaultController::class, 'store'])->name('fault-add-form');
Route::get('/fault/index', [FaultController::class, 'index'])->name('fault-index');
Route::get('/fault/edit/{id}', [FaultController::class, 'edit'])->name('fault-edit');
Route::post('/fault/update/{id}', [FaultController::class, 'update'])->name('fault-update');
Route::post('/fault/close/{id}', [FaultController::class, 'close'])->name('fault-close');


Route::get('/incident/new', [IncidentController::class, 'create'])->name('incident-new');
Route::post('/incident/submit', [IncidentController::class, 'store'])->name('incident-add');
Route::get('/incident/index', [IncidentController::class, 'index'])->name('incident-index');
Route::get('/incident/update/{id}', [IncidentController::class, 'update'])->name('incident-update');
Route::get('/incident/show/{id}', [IncidentController::class, 'show'])->name('incident-show');
Route::post('/incident/update/{id}', [IncidentController::class, 'update'])->name('incident-update');
Route::get('/incident/destroy/{id}', [IncidentController::class, 'destroy'])->name('incident-destroy');

//Route для формы акта-допуска
Route::get('/act/act_form', 'ActController@create')->name('act-form');
// Route::post('/act/submit', 'ActController@store')->name('act-store');
// Route::get('/act/print/{id}', 'ActController@print')->name('act-print');
// Route::get('/act/index', 'ActController@index')->name('act-index');
// Route::post('/act/update/{id}', 'ActController@update')->name('act-update');
// Route::get('/act/approval', 'ActController@approval')->name('act-approval');

//отправка почты
Route::get('/send-email', [FeedbackController::class, 'send'])->name('email-security-report');