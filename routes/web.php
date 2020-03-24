<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/chat', 'HomeController@index')->name('chat');
Route::get('/chat/{conversationId}', 'HomeController@index')->name('chat');

Route::get('/profile', 'ProfileController@edit')->name('profile');
Route::post('/profile', 'ProfileController@update');

Route::get('/api/conversations', 'ConversationController@index');
Route::get('/api/messages', 'MessageController@index');
Route::post('/api/messages', 'MessageController@store');
