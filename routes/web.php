<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::resource('receipts', 'ReceiptsController');
Route::resource('payments', 'PaymentsController');
Route::resource('clients', 'ClientsController');
