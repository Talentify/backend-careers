<?php

Route::get('/', 'VagaController@index')->name('lista.vagas');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'UserController@index')->name('login');
Route::post('/login', 'UserController@logar')->name('login.entrar');
Route::get('/adm', 'PainelController@index')->name('adm.index');
Route::post('/adm', 'PainelController@store')->name('adm.cadastro');
Route::get('/logout', 'UserController@logout')->name('user.logout');
