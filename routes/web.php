<?php
Route::any('/wechat', 'WeChatController@serve');

Route::get('test/index', 'TestController@index')->name('test.index');

//登录相关
Route::get('register/auth/wechat', 'AuthController@regwechat')->name('register.auth.wechat');
Route::any('login', 'AuthController@login')->name('login');
Route::any('register', 'AuthController@register')->name('register');
Route::get('logout', 'AuthController@logout')->name('logout');
Route::any('login/bycode', 'AuthController@bycode')->name('login.bycode');
Route::get('login/wechat', 'AuthController@wechat')->name('login.wechat');
Route::get('login/wechatCallback', 'AuthController@wechatCallback')->name('login.wechatCallback');
Route::any('auth/forgot', 'AuthController@forgot')->name('forgot');
Route::any('auth/forgot/reset', 'AuthController@reset')->name('forgot.reset')->middleware('signed');
Route::post('auth/sms', 'AuthController@smsCode')->name('auth.sms');

// 个人中心
Route::any('user/alliance', 'UserController@alliance')->name('user.alliance');
Route::get('user/agency', 'UserController@agency')->name('user.agency');
Route::post('user/store', 'UserController@store')->name('user.store');
Route::get('user/rules', 'UserController@rules')->name('user.rules');
Route::get('user/relation', 'UserController@relation')->name('user.relation');
Route::post('user/relationrun', 'UserController@relationrun')->name('user.relationrun');
Route::get('user', 'UserController@index')->name('user.index');

//首页
Route::get('/', 'IndexController@index')->name('index.index');

//诵经
Route::get('chant', 'ChantController@index')->name('chant.index');
Route::get('chant/report', 'ChantController@report')->name('chant.report');
Route::post('chant/reportdo', 'ChantController@reportdo')->name('chant.reportdo');
Route::get('chant/more', 'ChantController@more')->name('chant.more');
Route::any('chant/{chant}/edit', 'ChantController@edit')->name('chant.edit');
Route::get('chant/{chant}/delete', 'ChantController@delete')->name('chant.delete');

//抄经
Route::get('write', 'WriteController@index')->name('write.index');
Route::get('write/report', 'WriteController@report')->name('write.report');
Route::post('write/reportdo', 'WriteController@reportdo')->name('write.reportdo');
Route::get('write/more', 'WriteController@more')->name('write.more');
Route::any('write/{write}/edit', 'WriteController@edit')->name('write.edit');
Route::get('write/{write}/delete', 'WriteController@delete')->name('write.delete');

//设置
Route::get('settings/index', 'SettingController@index')->name('settings.index');
Route::any('settings/password', 'SettingController@password')->name('settings.password');
Route::post('settings/update', 'SettingController@update')->name('settings.update');
Route::match(['get', 'put'], 'setting/{user}/info/{field}', 'SettingController@info')->name('setting.info');
Route::post('setting/{user}/avatar', 'SettingController@avatar')->name('setting.avatar');

// 图片上传
Route::match(['get', 'post'], 'storages/picture', 'StorageController@picture')->name('storages.picture');

//
Route::get('data/my', 'DataController@my')->name('data.my');
Route::get('data/index', 'DataController@index')->name('data.index');
Route::get('newdata/index', 'NewDataController@index')->name('newdata.index1');
Route::get('data/chants', 'DataController@chants')->name('data.chants');
Route::get('data/writes', 'DataController@writes')->name('data.writes');

//我的数据
Route::get('mydata/index', 'MyDataController@index')->name('mydata.index');
Route::any('mydata/year', 'MyDataController@year')->name('mydata.year');
Route::any('mydata/{data}/yeardo', 'MyDataController@yeardo')->name('mydata.yeardo');
Route::any('mydata/all', 'MyDataController@all')->name('mydata.all');
Route::any('mydata/{data}/alldo', 'MyDataController@alldo')->name('mydata.alldo');
Route::any('mydata/desires', 'MyDataController@desires')->name('mydata.desires');
Route::any('mydata/{data}/desiresdo', 'MyDataController@desiresdo')->name('mydata.desiresdo');

//文章
Route::get('articles/index', 'ArticleController@index')->name('articles.index');
Route::get('articles/{article}/show', 'ArticleController@show')->name('articles.show');
Route::get('articles/meditation', 'ArticleController@meditation')->name('articles.meditation');
