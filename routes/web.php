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

Route::get('/', 'App\Http\Controllers\IndexController@index');


/*
 * Add Event
 */
Route::post('/addEvent', 'App\Http\Controllers\EventController@addEvent');

/*
 * Get Special Event
 */
Route::post('/getSpecialEvent', 'App\Http\Controllers\EventController@getSpecialEvent');

/*
 * Login
 */
Route::get('/admin', 'App\Http\Controllers\LoginController@index');
Route::post('/authenticate', 'App\Http\Controllers\LoginController@authenticate');

