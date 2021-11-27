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

Route::get('/', 'App\Http\Controllers\EventController@index');


/*
 * Add Event
 */
Route::post('/addEvent', 'App\Http\Controllers\EventController@addEvent');

/*
 * Get Special Event
 */
Route::post('/getSpecialEvent', 'App\Http\Controllers\EventController@getSpecialEvent');

Route::group(['middleware' => ['guest']], function ()
{
    /*
   * Login
   */
    Route::get('/admin', 'App\Http\Controllers\LoginController@index')->name("login");
    Route::post('/authenticate', 'App\Http\Controllers\LoginController@authenticate');
});


Route::group(['middleware' => ['auth']], function ()
{
    /*
   * Panel
   */
    Route::get('/panel', 'App\Http\Controllers\Back\PanelController@index');
});

