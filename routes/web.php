<?php

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

//Route::get('/', function () {
//    return view('main');
//});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

Route::get('/dashboard','DashboardPMController@showDashboard')->name('dashboard');
Route::get('CreateMaterial','DashboardPMController@showCreatematerial')->name('material');
Route::post('CreateMaterial','DashboardPMController@Creatematerial')->name('addMaterial');
Route::get('CreateExam','DashboardPMController@showCreateExam')->name('exam');
Route::get('CreateQuestion','DashboardPMController@showCreateQuestion')->name('question');
    Route::post('CreateQuestion','DashboardPMController@CreateQuestion')->name('addQuestion');

Route::post('addExam','DashboardPMController@CreateExam')->name('addExam');

Route::get('CreateSection','DashboardPMController@showCreateSection')->name('section');
    Route::post('CreateSection/add','DashboardPMController@CreateSection')->name('addSection');
    Route::post('CreateSubSection','DashboardPMController@CreateSubSection')->name('addSubsection');
Route::get('showLeaderboard','DashboardPMController@showleaderBoard')->name('leaderboard');
Route::get('ajax', 'DashboardPMController@getdata');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
