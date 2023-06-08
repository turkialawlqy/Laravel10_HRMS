<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Admin_panel_settingController;
use App\Http\Controllers\Admin\Finance_calendersController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\ShiftsTypesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
define('PC',1);
Route::group([ 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
/*  بداية الضبط العام */
Route::get('/generalSettings',[Admin_panel_settingController::class,'index'])->name('admin_panel_settings.index');
Route::get('/generalSettingsEdit',[Admin_panel_settingController::class,'edit'])->name('admin_panel_settings.edit');
Route::get('/generalSettingsupdate',[Admin_panel_settingController::class,'update'])->name('admin_panel_settings.update');
/*  بداية  تكويد السنوات المالية */
Route::get('/finance_calender/delete/{id}',[Finance_calendersController::class,'destroy'])->name('finance_calender.delete');
Route::post('/finance_calender/show_year_monthes',[Finance_calendersController::class,'show_year_monthes'])->name('finance_calender.show_year_monthes');
Route::get('/finance_calender/do_open/{id}',[Finance_calendersController::class,'do_open'])->name('finance_calender.do_open');
Route::resource('/finance_calender', Finance_calendersController::class);
/* بداية الفروع */
Route::get("/branches",[BranchesController::class,'index'])->name('branches.index');
Route::get("/branchesCreate",[BranchesController::class,'create'])->name('branches.create');
Route::post("/branchesStore",[BranchesController::class,'store'])->name('branches.store');
Route::get("/branchesEdit/{id}",[BranchesController::class,'edit'])->name('branches.edit');
Route::post("/branchesUpdate/{id}",[BranchesController::class,'update'])->name('branches.update');
Route::get("/branchesDelete/{id}",[BranchesController::class,'destroy'])->name('branches.destroy');

/* بداية انواع شفتات الموظفين */
Route::get("/ShiftsTypes",[ShiftsTypesController::class,'index'])->name('ShiftsTypes.index');
Route::get("/ShiftsTypesCreate",[ShiftsTypesController::class,'create'])->name('ShiftsTypes.create');
Route::post("/ShiftsTypesStore",[ShiftsTypesController::class,'store'])->name('ShiftsTypes.store');
Route::get("/ShiftsTypesEdit/{id}",[ShiftsTypesController::class,'edit'])->name('ShiftsTypes.edit');
Route::post("/ShiftsTypesUpdate/{id}",[ShiftsTypesController::class,'update'])->name('ShiftsTypes.update');
Route::get("/ShiftsTypesDestroy/{id}",[ShiftsTypesController::class,'destroy'])->name('ShiftsTypes.destroy');


});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});
Route::fallback(function(){
return redirect()->route('admin.showlogin');
});