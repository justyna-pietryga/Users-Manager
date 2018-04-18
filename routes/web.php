<?php

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
use App\MyUser;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view("welcome");
});

Route::resource('api/users', 'UsersController');

Route::post('/', function (Request $request) {
    return MyUser::create($request->all());
});