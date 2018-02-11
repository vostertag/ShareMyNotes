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

// Home
Route::get('/', 'HomeController@index')->name('home');

// Account
Route::get('/account', 'UserController@index')->name('account');
Route::post('/account', 'UserController@update')->name('updateAccount');
Route::post('/delete', 'UserController@delete')->name('delete');

// Notes
Route::get('/note', 'NoteController@add')->name('newNote');
Route::post('/note', 'NoteController@store')->name('addNote');
Route::get('/note/edit/{note}', 'NoteController@edit')->name('editNote');
Route::post('/note/edit/{note}', 'NoteController@update')->name('editNote');
Route::post('/note/search', 'NoteController@search')->name('searchNote');
Route::post('/note/delete', 'NoteController@delete')->name('deleteNote');

// Courses
Route::post('/', 'CourseController@save')->name('addCourse');
Route::post('/courses/edit', 'CourseController@edit')->name('editCourse');
Route::get('/courses/delete/{course}', 'CourseController@delete')->name('deleteCourse');
Route::get('/courses', 'CourseController@joinCourse')->name('showCourses');
Route::get('/course/{course}', 'CourseController@index')->name('course');
Route::get('/course/join/{course}', 'CourseController@joinThisCourse')->name('joinCourse');
Route::get('/course/leave/{course}', 'CourseController@leaveCourse')->name('leaveCourse');

// Groups
Route::get('/groups', 'GroupController@index')->name('groups');
Route::post('/groups', 'GroupController@save')->name('addGroup');
Route::get('/groups/join/{token}', 'GroupController@join')->name('joinGroup');
Route::get('groups/leave/{group}', 'GroupController@leave')->name('leaveGroup');


// Storage
Route::get('image/{name}', 'StorageController@image')->name('image');
Route::get('file/{name}', 'StorageController@file')->name('file');


// Login and log out Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register/{role}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register/{role}', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
