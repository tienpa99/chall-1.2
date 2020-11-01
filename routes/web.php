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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/change', 'HomeController@change')->name('change');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/members', 'HomeController@showUser')->name('members');

Route::post('/change', 'UserController@update')->middleware('auth')->name('changeInfo');

Route::get('/add',function(){
	return view('add');
})->middleware('auth')->name('addMember');

Route::post('/add','UserController@store')->middleware('auth')->name('addMember2');

Route::get('/delete/{id}','UserController@destroy')->middleware('auth')->name('delete');

Route::get('/edit/{id}','UserController@edit')->middleware('auth')->name('edit');

Route::post('/edit/{id}','UserController@update2')->middleware('auth')->name('editMember');

Route::get('/views/{id}','UserController@view')->middleware('auth')->name('views');

Route::resource('/assignments','AssignmentController')->middleware('auth');

Route::resource('/quizzes','QuizController')->middleware('auth');

Route::post('/assignments/show/{id}','AssignmentController@studentSubmit')->middleware('auth')->name('studentSubmit');
Route::post('/quizzes/answer/{id}','QuizController@answer')->middleware('auth')->name('quizzes.answer');
