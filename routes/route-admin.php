<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     

//admin-auth
Route::group(['prefix' =>'admin-auth','namespace' => 'App\Http\Controllers\Admin\Auth'], function() {
    Route::get('login','AdminController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','AdminController@postLoginAdmin');

    Route::get('logout','AdminController@getLogoutAdmin')->name('get.logout.admin');
});
Route::group(['prefix'=>'api-admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>'check_admin_login'],function(){
    Route::get('','AdminController@index')->name('admin.index'); 
    Route::group(['prefix'=>'user'],function(){
        Route::get('','EmployeeController@index')->name('admin.employee.index');
        Route::get('create','EmployeeController@create')->name('admin.employee.create');
        Route::post('create','EmployeeController@store');
        Route::get('update/{id}','EmployeeController@edit')->name('admin.employee.update');
        Route::post('update/{id}','EmployeeController@update');
        Route::get('delete/{id}','EmployeeController@delete')->name('admin.employee.delete'); 
    });
    Route::group(['prefix'=>'role'],function(){
        Route::get('','RoleController@index')->name('admin.role.index');
        Route::get('create','RoleController@create')->name('admin.role.create');
        Route::post('create','RoleController@store');
        Route::get('update/{id}','RoleController@update')->name('admin.role.update');
        Route::post('update/{id}','RoleController@edit');
        Route::get('delete/{id}','RoleController@delete')->name('admin.role.delete'); 
    });
});