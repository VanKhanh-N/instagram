<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     
include('route-admin.php'); 


Route::get('/','App\Http\Controllers\HomeController@index')->name('home'); 
 Route::group(['namespace' =>'App\Http\Controllers\Auth','prefix'=>'account'],function(){
    Route::get('register','RegisterController@getFormRegister')->name('get.register'); // đăng ký
    Route::post('register','RegisterController@create'); // xử lý đăng ký


    Route::get('verify/{user}','RegisterController@getVerifyAccount')->name('user.verify.gmail');//xác thực qua email
    Route::get('verify-phone','RegisterController@getVerifyMessage')->name('user.verify.message');//xác thực qua tin nhắn
    Route::post('verify-phone','RegisterController@postVerifyMessage');//xác thực qua tin nhắn

    Route::get('login','LoginController@getFormLogin')->name('get.login'); // đăng nhập
    Route::post('login','LoginController@postLogin'); // xử lý đăng nhập
    
    Route::get('forgot-password','ResetPasswordController@getFormPassword')->name('get.forgot-password'); // quên mật khẩu
    Route::post('forgot-password','ResetPasswordController@postPassword'); // xử lý quên mật khẩu
    Route::get('accounts/password/reset','ResetPasswordController@changePassword')->name('user.change.password'); // thay đổi mật khẩu
    Route::post('accounts/password/reset','ResetPasswordController@StorePassword'); // thay đổi mật khẩu

    Route::get('logout','LoginController@getLogout')->name('get.logout'); // đăng xuất

});

Route::group(['namespace'=>'App\Http\Controllers\Personal'], function () {   
    Route::get('/explore','ExploreController@index')->name('explore'); 
    Route::get('/direct','DirectController@index')->name('direct');   
    Route::get('/searchmess','DirectController@searchmess')->name('searchmess');  
    Route::get('/direct/{id}', 'DirectController@show')->name('chat.show');
    Route::get('/home',  'DirectController@show')->name('chat.video');
    Route::post('/pusher/auth', 'App\Http\Controllers\HomeController@authenticate'); 
    Route::post('/chat/getChat/{id}', 'DirectController@getChat');
    Route::post('/chat/sendChat', 'DirectController@sendChat');

});
//home page
Route::group(['namespace'=>'App\Http\Controllers\Page'], function () { 
    //follow user
    Route::get('/p/{slug}','HomePageController@view_post')->name('post.view'); 
    Route::get('/incre-view','HomePageController@incre_view')->name('post.increview'); 
    Route::get('/follow','HomePageController@follow'); 
    Route::post('/upload_user','HomePageController@uploadProfile')->name('upload.user'); 
    Route::get('/delete','HomePageController@deleteProfile')->name('post.delete');
    Route::get('/{user}','HomePageController@index')->name('get.home-page');   
    Route::post('/upload','HomePageController@saveProfile')->name('post.profile'); 
    
});

Route::get('/auth/redirect/{provider}', 'App\Http\Controllers\SocialController@redirect');
Route::get('/callback/{provider}', 'App\Http\Controllers\SocialController@callback');

Route::group(['namespace'=>'App\Http\Controllers\Activate'], function () {   
    // post image
    Route::get('/like/post','PostImage@LikePost')->name('like.post'); 
    Route::get('/comment/post','PostImage@CommentPost')->name('comment.post');  
    Route::get('/share/post','PostImage@SharePost')->name('share.post');  
    //post video
    Route::get('/upload/video','PostVideo@UploadVideo')->name('upload.video'); 
    Route::post('/upload/video','PostVideo@StoreVideo'); 
    Route::get('/like/video','PostVideo@LikeVideo')->name('like.video'); 
    Route::get('/comment/video','PostVideo@CommentVideo')->name('comment.video');  
    Route::get('/share/video','PostVideo@ShareVideo')->name('share.video');  
    //change languge 
    Route::get('/language/{language}','LanguageController@index')->name('language');
    //notification
    Route::post('/notification/get','NotificationController@index'); 
    Route::post('/notification/read','NotificationController@read'); 

});

Route::group(['prefix'=>'accounts','namespace'=>'App\Http\Controllers\Account'], function () {   
    Route::get('/edit','ProfileController@edit')->name('profile.edit');  
    Route::post('/edit/store','ProfileController@store')->name('profile.store');    
    Route::get('/edit/password','ProfileController@password')->name('password.edit'); 
    Route::post('/edit/password/store','ProfileController@store_password')->name('password.store');  

});
