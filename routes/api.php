<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'api', 'prefix' => 'auth/user'], function () {

//    Route::post('login', 'AuthController@login');
  //  Route::post('logout', 'AuthController@logout');
   // Route::post('refresh', 'AuthController@refresh');
   // Route::post('me', 'AuthController@me');

});
Route::group(['prefix'=>'api'],function (){
  //     Route::post('/login','AuthController@login');
    //Route::get('/getFormData','AuthController@getFormData');
    //Route::post('/user-details','AuthController@createUser');
  //Route::group(['perfix'=>'material'],function (){
   //Route::get('/add','');
  //});
    Route::group(['prefix'=>'student'],function()
    {
        Route::post('/completeProfile','StudentController@completeProfile');
       Route::post('/material','StudentController@showmaterial');
       Route::post('/sections','StudentController@showsections');
       Route::post('exams','StudentController@showexams');
        Route::post('questions','StudentController@showquestions');
       Route::post('/results','StudentController@getresult');

    });

    Route::group(['prefix'=>'manager'],function()
    {
        Route::post('/finalExam','ProjectManagerController@');
        Route::get('/category','ProjectManagerController@SendData');
        Route::post('/material','ProjectManagerController@CreateMaterial');
        Route::post('/sections','ProjectManagerController@CreateSectionSub');
        Route::post('/exams','ProjectManagerController@CreateExamQue');
       // Route::post('questions/{id}','StudentController@showquestions');
        Route::get('/leaderboard','ProjectManagerController@LeaderBoard');
    });
});


