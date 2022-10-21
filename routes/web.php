<?php

use App\Http\Controllers\Admins;
use App\Http\Controllers\attendence;
use App\Http\Controllers\exam;
use App\Http\Controllers\exercise;
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
    'verify' => false, // Email Verification Routes...
  ]);
  

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
    Route::get('attendence/list','attendlist')->name('attendlist');
    Route::post('attendence/edit','readattend')->name('readattend');
    Route::post('attendence/store','storeattend')->name('storeattend');
    Route::put('attendence/update','attendupdate')->name('attendupdate');
    Route::delete('attendence/delete/{date}','attenddelete')->name('attenddelete');
});

Route::controller(theme::class)->group(function (){
    Route::get('theme/dark','setdark')->name('themedark');
    Route::get('theme/light','setlight')->name('themelight');
});

Route::controller(exam::class)->group(function (){
    Route::get('exam/list','examlist')->name('lstexm');
    Route::get('exam/add','add')->name('addexm');
    Route::post('exam/edit', 'readcexm')->name('editexm');
    Route::post('exam/update', 'examupdate')->name('examupdate');
    Route::post('exam/store','storeexm')->name('storeexm');
    Route::delete('exam/delete/{date}', 'delete')->name('deleteexm');
});
Route::controller(exercise::class)->group(function (){
    Route::get('exercise/list','exerciselist')->name('exerciselist');
    Route::get('exercise/add','exerciseadd')->name('exerciseadd');
    Route::post('exercise/edit', 'readexercise')->name('editexercise');
    Route::post('exercise/update', 'exerciseupdate')->name('exerciseupdate');
    Route::post('exercise/store','exercisestore')->name('exercisestore');
    Route::delete('exercise/delete/{date}', 'exercisedelete')->name('deleteexercise');
});

Route::controller(student::class)->group(function () {
     Route::get('std/std', 'read')->name('std');
     Route::get('std/add', 'add')->name('add');
     Route::post('std/edit/', 'edit')->name('edit');
     Route::put('std/update/', 'update')->name('update');
     Route::delete('std/delete/', 'delete')->name('delete');
     Route::post('store_std', 'store')->name('store_std');
     Route::get('std/m','read_m')->name('read_m');
     Route::get('std/f','read_f')->name('read_f');
 });
