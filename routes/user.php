<?php
/**
 *
 *
 *User CRUDE
 *
 */
//user CRUD....................................

Route::get('user',[
    'as'=>'user.index',
    'uses'=>'Admin\UserController@index',
    'title'=>'Users'
]);
//user create
Route::get('user/create',[
    'as'=>'user.create',
    'uses'=>'Admin\UserController@create',
    'title'=>'Add Users'
]);
//user insert
Route::post('store',[
    'as'=>'user.store',
    'uses'=>'Admin\UserController@store',
    'title'=>'Store Users'
]);
//user edit
Route::get('user/{id}/edit',[
    'as'=>'edit_user.edit',
    'uses'=>'Admin\UserController@edit',
    'title'=>'Edit Users'
]);  //user change Password
Route::get('user/profile',[
    'as'=>'profile',
    'uses'=>'Admin\UserController@changeProfile',
    'title'=>'User Profile'
]);  
Route::put('user/Update_profile/{id}',[
    'as'=>'update.profile',
    'uses'=>'Admin\UserController@updateProfile',
    'title'=>'Update Users Profile'
]);
//user update
Route::put('user/{id}/edit',[
    'as'=>'user.update',
    'uses'=>'Admin\UserController@update',
    'title'=>'Update Users'

]);
//user trash
Route::get('user/{id}/trash',[
    'as'=>'user.trash',
    'uses'=>'Admin\UserController@trash',
    'title'=>'Trash Users'


]);
//user restore
Route::get('user/{id}/restore',[
    'as'=>'user.restore',
    'uses'=>'Admin\UserController@restore',
    'title'=>'Restore Users'
]);
//user Delete
Route::get('user/{id}/delete',[
    'as'=>'user.delete',
    'uses'=>'Admin\UserController@destroy',
    'title'=>'Delete Users'

]);
