<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/user/{id}/{name}', function ($id, $name) {
    return '<h2>This is user '.$name.' with an id of '.$id.'</h2>';
});
*/

Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about');
Route::get('/services', 'PageController@services');

Route::resource('posts', 'PostController'); //DEVNOTE: shorthand helper method will create and mapp all the associated RESTful --resource routes

Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
