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
//主页路由
Route::get('/','PagesController@index')->name('home');
//注册登陆路由
Auth::routes();

//用户中心路由
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);


Route::resource('microblogs', 'MicroblogsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);