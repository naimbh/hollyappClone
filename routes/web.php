<?php

use Illuminate\Support\Facades\Route;

//note routes
Route::group(['as' => 'note.'], function (){
    Route::get('trees', 'NoteController@index')->name('index');
    Route::get('note/{slug}', 'NoteController@create')->name('create');
    Route::post('note/store', 'NoteController@store')->name('store');
    Route::post('note/update/{slug}', 'NoteController@update')->name('update');
    Route::post('note/delete/{slug}', 'NoteController@destroy')->name('destroy');
    Route::get('pdf', 'NoteController@makePDF')->name('pdf');
});

//homapage routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('privacy', 'HomeController@privacy')->name('privacy');
Route::get('plans', 'HomeController@plans')->name('plans');
Route::get('imprint', 'HomeController@imprint')->name('imprint');
Route::get('terms', 'HomeController@terms')->name('terms');
Route::get('new', 'HomeController@new')->name('new');


//auth routes
Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    Route::get('dashboard', 'NoteController@dashboard')->name('dashboard');
    Route::get('protect/{slug}', 'ProtectController@create')->name('protect');
    Route::post('protect/link/{slug}', 'ProtectController@protect')->name('protect.password');
    Route::get('unprotect/{slug}', 'ProtectController@unprotect')->name('unprotect');
});

//password protect check
Route::post('protect/check/{slug}', 'ProtectController@protectCheck')->name('protect.check');


//subscribe routes
Route::group(['middleware' => 'auth'], function (){
    Route::post('subscribe/{subscriptionId}', 'SubscriptionController@subscribe')->name('subscribe');
});

//backend routes
Route::get('admin/dashboard', 'AdminController@index')->name('admin.dashboard');
Route::get('admin/dashboard/users', 'AdminController@users')->name('admin.users');
Route::get('admin/user/subscribe/{user}', 'AdminController@subscribeToggle')->name('user.subscribeToggle');
Route::get('admin/user/delete/{user}', 'AdminController@deleteUser')->name('user.deleteUser');

Route::get('admin/dashboard/notes', 'AdminController@notes')->name('admin.notes');
Route::get('admin/note/delete/{note}', 'AdminController@deleteNote')->name('note.deleteNote');

