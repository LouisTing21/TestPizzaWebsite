<?php

use App\Models\User;
use App\Models\Category;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');




Route::group(['prefix'=>'category','namespace'=>'Api','middleware'=>'auth:sanctum'],function(){
    Route::get('list','apiController@categoryList');
    Route::post('create','apiController@categoryCreate');
    Route::get('detail/{id}','apiController@categoryDetail');
    Route::get('delete/{id}','apiController@delete');
    Route::post('update','apiController@update');
    Route::post('search','apiController@search');
});

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('logout','AuthController@logout');
});
