<?php

use App\Http\Controllers\Admins;
use App\Http\Controllers\attendence;
use App\Http\Controllers\exam;
use App\Http\Controllers\exercise;
use App\Http\Controllers\groups;
use App\Http\Controllers\student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\theme;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
    return view('index');
});

//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false,
    'home' => false, // Email Verification Routes...
  ]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(Admins::class)->group(function () {
    Route::get('admin/list','list')->name('adminlist');
    Route::get('admin/add','add')->name('adminadd');
    Route::post('admin/insert','storeadmin')->name('storeadmin');
    Route::delete('admin/delete/{id}','admindelete')->name('admindelete');
    Route::post('admin/edit/','edit')->name('adminedit');
    Route::post('admin/update','adminupdate')->name('adminupdate');
});

Route::controller(attendence::class)->group(function(){
    Route::get('attendence/new','new')->name('attendencenew');
    Route::get('attendence/new/sec/{id}','new_sec')->name('add_attend');
    Route::get('attendence/new/excel','attend_excel')->name('attend_excel');
    Route::get('attendence/new/excel/stamp','attend_stamp')->name('attend_stamp');
    Route::post('attendence/new/excel/store','store_excel')->name('attend_store_excel');
    Route::get('attendence/list','attendlist')->name('attendlist');
    Route::get('attendence/list/sec/{id}','attendlist_sec')->name('lst_attend');
    Route::get('attendence/edit/{id}','readattend')->name('readattend');
    Route::post('attendence/store','storeattend')->name('storeattend');
    Route::put('attendence/update','attendupdate')->name('attendupdate');
    Route::get('attendence/delete/{id}','attenddelete')->name('attenddelete');
    Route::post('attend/absent','absent_all')->name('absent_all');
});

Route::controller(student::class)->group(function () {
    Route::get('std/std', 'read')->name('std');
    Route::get('std/add', 'add')->name('add');
    Route::get('std/edit/{id}', 'edit')->name('edit');
    Route::put('std/update/', 'update')->name('update');
    Route::delete('std/delete/', 'delete')->name('delete');
    Route::post('store_std', 'store')->name('store_std');
    Route::get('std/sec/{id}','read_sec')->name('read');
    Route::get('std/excel','std_excel')->name('std_excel');
    Route::get('std/excel/stamp','std_stamp')->name('std_stamp');
    Route::post('std/excel/store','store_excel')->name('store_excel');
});

Route::controller(exam::class)->group(function (){
    Route::get('exam/list','index')->name('lstexm');
    Route::get('exam/list/sec/{id}','list_exam')->name('list_exam');
    Route::get('exam/add','add')->name('addexm');
    Route::get('exam/add/sec/{id}','add_exm')->name('add_exm');
    Route::get('exam/edit/{id}', 'readcexm')->name('editexm');
    Route::post('exam/update', 'examupdate')->name('examupdate');
    Route::post('exam/store','storeexm')->name('storeexm');
    Route::get('exam/delete/{id}', 'delete')->name('deleteexm');
    Route::get('exam/add/excel','Exm_Excel')->name('Exm_Excel');
    Route::get('exam/add/excel/stamp','Exm_stamp')->name('Exm_stamp');
    Route::post('exam/add/excel/store','store_excel')->name('Exm_store');
});
Route::controller(exercise::class)->group(function (){
    Route::get('exercise/list','exerciselist')->name('exerciselist');
    Route::get('exercise/list/{id}','lst_exc')->name('lst_exc');
    Route::get('exercise/add','exerciseadd')->name('exerciseadd');
    Route::get('exercise/add/sec/{id}','add_exc')->name('add_exc');
    Route::get('exercise/edit/{id}', 'readexercise')->name('editexercise');
    Route::post('exercise/update', 'exerciseupdate')->name('exerciseupdate');
    Route::post('exercise/store','exercisestore')->name('exercisestore');
    Route::get('exercise/delete/{id}', 'exercisedelete')->name('deleteexercise');
    Route::get('exercise/add/excel','exercise_Excel')->name('exercise_Excel');
    Route::get('exercise/add/excel/stamp','exercise_stamp')->name('exercise_stamp');
    Route::post('exercise/add/excel/store','store_excel')->name('exercise_store_sheet');
});

Route::controller(theme::class)->group(function (){
    Route::get('theme/dark','setdark')->name('themedark');
    Route::get('theme/light','setlight')->name('themelight');
});
