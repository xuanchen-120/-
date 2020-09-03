<?php
// 主面板
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

// ajax
Route::post('ajaxs/getcities', 'AjaxController@getcities')->name('ajaxs.getcities');
Route::post('ajaxs/getdistrict', 'AjaxController@getdistrict')->name('ajaxs.getdistrict');

// 上传文件与编辑器
Route::get('storages', 'StoragesController@index')->name('storages.index');
Route::match(['get', 'post'], 'storages/picture', 'StoragesController@picture')->name('storages.picture');
Route::any('ueditor', 'UeditorController@index')->name('ueditor');

// 轮播管理
Route::get('banners/nodecreate/{position}', 'BannerController@nodeCreate')->name('banners.nodeCreate');
Route::post('banners/nodestore/{position}', 'BannerController@nodeStore')->name('banners.nodeStore');
Route::delete('banners/nodedelete/{banner}', 'BannerController@nodeDelete')->name('banners.nodeDelete');
Route::resource('banners', 'BannerController');

// 文章管理
Route::resource('articles', 'ArticleController');

// 分类管理
Route::resource('categories', 'CategoryController');

// 会员管理
Route::get('users/sync', 'UserController@sync')->name('users.sync');
Route::resource('users', 'UserController', ['except' => 'show']);

// 微信菜单
Route::get('wechatmenus/sync', 'WechatMenuController@sync')->name('wechatmenus.sync');
Route::get('wechatmenus/publish', 'WechatMenuController@publish')->name('wechatmenus.publish');
Route::resource('wechatmenus', 'WechatMenuController', ['except' => 'show']);

//诵经记录
Route::get('chants/index', 'ChantController@index')->name('chants.index');

//抄经记录
Route::get('writes/index', 'WriteController@index')->name('writes.index');
