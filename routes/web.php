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
Route::get('/','HomeController@index')->name('home');

//注册登陆路由
Auth::routes();

//用户中心路由
Route::resource('users', 'UsersController', ['only' => ['index','show', 'update', 'edit']]);
Route::get('users','UsersController@index')->name('users.index');

//微博增删改查路由
Route::resource('microblogs', 'MicroblogsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

//个人页面查看个人微博路由
Route::get('users/{user}/microblogs','MicroblogsController@showPerson')->name('microblogs.showPerson');

Route::post('upload_image', 'MicroblogsController@uploadImage')->name('microblogs.upload_image');

//获取关注列表和粉丝列表路由
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

//关注用户和取消关注用户
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');

//获取评论和回复的路由
Route::post('/microblogs/{microblog}/storeComment','CommentsController@store')->name('comments.store');
Route::post('/microblogs/{microblog}/comments/{replyObject}','CommentsController@storeReplies')->name('comments.storeReplies');

//删除回复路由
Route::post('/comments/{comment}/destroy','CommentsController@destroy')->name('comments.destroy');

//通知路由
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

//点赞漏油
Route::get('/microblogs/{microblog}/like', 'MicroblogsController@like')->name('microblogs.like');