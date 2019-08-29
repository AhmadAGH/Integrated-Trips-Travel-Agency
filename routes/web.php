<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');


Route::resource('receipts', 'ReceiptsController');
Route::resource('payments', 'PaymentsController');
Route::resource('clients', 'ClientsController');
Route::resource('paymenttypes', 'PaymentTypesController');
Route::resource('users', 'UsersController');
