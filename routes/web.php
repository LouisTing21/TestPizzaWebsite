<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role=='admin'){
                return redirect()->route('admin#profile');
            }else if(Auth::user()->role=='user'){
                return redirect()->route('user#index');
            };
        };
    })->name('dashboard');
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin','middleware'=>[AdminMiddleware::class]],function(){

    Route::get('profile','AdminController@profile')->name('admin#profile');
    Route::post('updateProfile/{id}','AdminController@updateProfile')->name('admin#updateProfile');
    Route::get('changePassword','AdminController@changePasswordPage')->name('admin#changePage');
    Route::post('changePassword/{id}','AdminController@changePassword')->name('admin#changePassword');

    Route::get('adminList/edit/{id}','AdminController@editAdminList')->name('admin#editAdminList');
    Route::post('adminList/update/{id}','AdminController@updateAdminList')->name('admin#updateAdminList');

    Route::get('userList/edit/{id}','AdminController@editUserList')->name('admin#editUserList');
    Route::post('userList/update/{id}','AdminController@updateUserList')->name('admin#updateUserList');


    Route::get('/','CategoryController@index')->name('admin#index');
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::get('category','CategoryController@category')->name('admin#category');
    Route::get('pizza', 'CategoryController@pizza')->name('admin#pizza');
    Route::post('createCategory','CategoryController@create')->name('admin#createCategory');
    Route::get('deleteCategory/{id}', 'CategoryController@delete')->name('admin#deleteCategory');
    Route::get('editCategory/{id}','CategoryController@edit')->name('admin#editCategory');
    Route::post('updateCategory/{id}','CategoryController@update')->name('admin#updateCategory');
    Route::get('category/search','CategoryController@search')->name('admin#searchCategory');
    Route::get('confirmCategory','CategoryController@confirm')->name('admin#confirmCategory');
    Route::get('realCategory','CategoryController@real')->name('admin#realCategory');
    Route::get('categoryItem/{id}','CategoryController@categoryItem')->name('admin#categoryItem');
    Route::get('category/download','CategoryController@csvDownload')->name('admin#csvDownload');

    Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
    Route::get('createPizza','PizzaController@createPizza')->name('admin#createPizza');
    Route::post('insertPizza','PizzaController@insertPizza')->name('admin#insertPizza');
    Route::get('deletePizza/{id}','PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('infoPizza/{id}','PizzaController@infoPizza')->name('admin#infoPizza');
    Route::get('editPizza/{id}','PizzaController@editPizza')->name('admin#editPizza');
    Route::post('updatePizza/{id}','PizzaController@updatePizza')->name('admin#updatePizza');
    Route::get('pizza/search','PizzaController@searchPizza')->name('admin#searchPizza');
    Route::get('pizza/download','PizzaController@csvDownload')->name('admin#pizzaDownload');

    Route::get('userList','UserController@userList')->name('admin#userList');
    Route::get('adminList','UserController@adminList')->name('admin#adminList');
    Route::get('adminList/search','UserController@adminSearch')->name('admin#adminSearch');
    Route::post('userList/search','UserController@userSearch')->name('admin#userSearch');
    Route::get('userList/delete/{id}','UserController@userDelete')->name('admin#userDelete');

    Route::get('order/list','OrderController@order')->name('admin#orderList');
    Route::get('order/search','OrderController@orderSearch')->name('admin#orderSearch');






});

Route::group(['prefix'=>'user','middleware'=>[UserMiddleware::class]],function(){
    Route::get('/','UserController@index')->name('user#index');
    Route::post('contact/create','ContactController@contactCreate')->name('user#contact');
    Route::get('contact/list','ContactController@contact')->name('admin#contactList');
    Route::get('contact/search','ContactController@contactSearch')->name('admin#contactSearch');
    Route::get('pizza/detials/{id}','UserController@detials')->name('admin#deetials');
    Route::get('category/search','UserController@categorySearch')->name('user#search');
    Route::get('category/search/pizza/{id}','UserController@pizzaSearch')->name('user#pizzaSearch');
    Route::get('pizza/search/price','UserController@priceSearchPizza')->name('user#priceSearch');
    Route::get('pizza/order','UserController@orderPage')->name('user#orderPage');
    Route::post('pizza/order','UserController@placeOrder')->name('user#placeOrder');
});
