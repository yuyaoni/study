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

Route::get('/', 'TeamsController@index');

// チャット登録処理
Route::post('send','TeamsController@add');

// 目標登録処理
Route::post('target','TeamsController@savetarget');

// 目標実績更新処理
Route::post('record','TeamsController@updaterecord');

Route::post('teams', 'TeamsController@store');

Route::get('team/{team_id}', 'TeamsController@join');

Route::get('teamedit/{team}', 'TeamsController@edit');

//チーム更新処理
Route::post('teams/update','TeamsController@update');

// チーム詳細表示
Route::get('teams/{team}','TeamsController@show');

//単元登録画面
Route::get('/admin','TeamsController@show2');

//マイページ
Route::get('/mypage','TeamsController@showMypage');

//進捗削除処理
Route::delete('delete','TeamsController@deleteRecord');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
