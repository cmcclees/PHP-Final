<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()
{
	return View::make('hello');
});*/




Route::get('login', array('as'=>'login','uses'=> 'LoginController@showLogin'));
Route::post('login', array('as'=>'login','uses'=> 'LoginController@processLogin'));

Route::get('register', array('as' => 'register', 'uses' => 'LoginController@register'));
Route::post('register', array('as'=>'register', 'uses' => 'LoginController@processRegister'));

Route::get('logout', array('as'=>'logout','uses'=> 'LoginController@logout'))->before('auth');


Route::get('dashboard', array('as'=>'dashboard','uses'=>'MovieController@dashboard'))->before('auth');
Route::get('movieSearch', array('as'=>'movieSearch','uses'=> 'MovieController@search'))->before('auth');
Route::get('watchedMovieList', array('as'=>'watchedMovieList','uses'=>'MovieController@listWatchedMovies'))->before('auth');

Route::post('searchedMovieList', array('as'=>'searchedMovieList','uses'=>'MovieController@listSearchedMovies'))->before('auth');

Route::post('createMovie', array('as'=>'createMovie', 'uses'=>'MovieController@createMovie'))->before('auth');
Route::get('createMovieManually', array('as'=>'createMovieManually', 'uses'=>'MovieController@createMovieManually'))->before('auth');


Route::post('insertMovie', array('as'=>'insertMovie', 'uses'=>'MovieController@insertMovie'))->before('auth');


Route::get('addMovie', array('as'=>'addMovie', 'uses'=>'ItunesController@movieSearch'))->before('auth');
Route::post('addMovie', array('as'=>'addMovie', 'uses'=>'ItunesController@movieProcess'))->before('auth');





