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

Route::get('/', 'QuestionsController@index');
//Auth::loginUsingId(1);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/email/verify/{token}', 'EmailController@verify')->name('email.verify');
Route::resource('questions', 'QuestionsController');
Route::post('question/{question}/answer', 'AnswersController@store');
Route::get('question/{question}/follow', 'QuestionFollowController@follow');
Route::get('notifications', 'NotificationsController@index');
Route::get('notifications/{notification}', 'NotificationsController@show');
Route::get('inbox','InboxController@index');
Route::get('inbox/{dialogId}','InboxController@show');
Route::post('inbox/{dialogId}/store','InboxController@store');
Route::get('avatar','UserController@avatar');
Route::post('avatar','UserController@changAvatar');
Route::get('password','PasswordController@password');
Route::get('password/update','PasswordController@update');
