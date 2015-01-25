<?php
/*
Route::controller('user', 'Qwerbit\User\Controllers\UserController');
*/
Route::get('/user/login',[
    'as' => 'user.login',
    'uses' => 'Qwerbit\User\Controllers\UserController@getLogin']);


Route::post('/user/login', 'Qwerbit\User\Controllers\UserController@postLogin');


Route::get('/user/reg/{ulogin_token?}', [
    'as' => 'user.reg',
    'uses' => 'Qwerbit\User\Controllers\UserController@getReg']);

Route::post('/user/reg', 'Qwerbit\User\Controllers\UserController@postReg');

Route::get('/user/profile', [
    'as' => 'user.profile',
    'uses' => 'Qwerbit\User\Controllers\UserController@getProfile']);


Route::post('/user/ulogin', [
    'as' => 'user.ulogin',
    'uses' => 'Qwerbit\User\Controllers\UserController@postUlogin']);



Route::any('/user/logout', [
    'as' => 'user.logout',
    'uses' => 'Qwerbit\User\Controllers\UserController@anyLogout']);


Mail::send('user::mail.reg', ['login'=>'Логин','password'=>'Пароль'], function ($message) {
                $message->to('alexbaks@bk.ru', 'Джон Смит')->subject('Привет!');
            });