<?php

Route::get('login', array('as'=>'login','uses'=> 'LoginController@showLogin'));
Route::post('login', array('as'=>'login','uses'=> 'LoginController@processLogin'));

Route::get('register', array('as' => 'register', 'uses' => 'LoginController@register'));
Route::post('register', array('as'=>'register', 'uses' => 'LoginController@processRegister'));

Route::get('logout', array('as'=>'logout','uses'=> 'LoginController@logout'));



Route::group(array('before' => 'auth'), function() {
    Route::resource('users', 'UserController');
    Route::resource('movies', 'MovieController');

    Route::get('dashboard', array('as'=>'dashboard','uses'=>'MovieController@dashboard'));

    Route::get('movieSearch', array('as'=>'movieSearch','uses'=> 'MovieController@search'));
    Route::get('watchedMovieList', array('as'=>'watchedMovieList','uses'=>'MovieController@listWatchedMovies'));

    Route::post('searchedMovieList', array('as'=>'searchedMovieList','uses'=>'MovieController@listSearchedMovies'));

    Route::post('createMovie', array('as'=>'createMovie', 'uses'=>'MovieController@createMovie'));
    Route::get('createMovieManually', array('as'=>'createMovieManually', 'uses'=>'MovieController@createMovieManually'));


    Route::post('insertMovie', array('as'=>'insertMovie', 'uses'=>'MovieController@insertMovie'));


    Route::get('addMovie', array('as'=>'addMovie', 'uses'=>'ItunesController@movieSearch'));
    Route::post('addMovie', array('as'=>'addMovie', 'uses'=>'ItunesController@movieProcess'));

});













