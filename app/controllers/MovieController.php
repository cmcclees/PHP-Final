<?php
/**
 * Created by PhpStorm.
 * User: cmcclees
 * Date: 2/11/14
 * Time: 6:11 PM
 */

class MovieController extends BaseController{

    public function search() {
        $genres[] = 'All';
        $genres += Genre::all()->lists('genre_name', 'id');
        return View::make('movies/search', array('genres' => $genres));
    }

    public function listWatchedMovies() {
        $user_id = Auth::user()->id;
        $movies = Movie::userMovies($user_id);
        $devices = Device::all()->lists('device_type', 'id');

        return View::make('movies/movies-list', [
            'movies' => $movies,
            'devices' => $devices,
        ]);
    }

    public function listSearchedMovies() {
        $title = Input::get('movie_name');
        $user_id = Auth::user()->id;
        $genre_id = Input::get('genre_id');
        $movies = Movie::searchUserMovies($title, $user_id, $genre_id);
        $devices = Device::all()->lists('device_type', 'id');

        return View::make('movies/movies-list', [
            'movies' => $movies,
            'devices' => $devices,
        ]);
    }



    public function createMovie() {
        $movieTitle = Input::get('movie_title');
        $genre_itunes = Input::get('genre');
        $genres = Genre::all()->lists('genre_name', 'id');
        $devices = Device::all()->lists('device_type', 'id');
        return View::make('movies/create', array('genres' => $genres, 'genre_itunes' => $genre_itunes, 'devices' => $devices, 'title' => $movieTitle));
    }

    public function createMovieManually() {
        $genres = Genre::all()->lists('genre_name', 'id');
        $devices = Device::all()->lists('device_type', 'id');
        return View::make('movies/createManually', array('genres' => $genres, 'devices' => $devices));
    }


    public function insertMovie() {
        $validation = Movie::validate(Input::all());

        if($validation->passes()) {
            $movie = new Movie();
            $movie->title = Input::get('movie_name');
            $movie->genre_id = Input::get('genre_id');

            $device_id = Input::get('device_id');
            $user_id = Auth::user()->id;


            User::find($user_id)->movies()->save($movie, array('device_id' => $device_id));



        return Redirect::to('createMovieManually')
            ->with('flash_notice', 'The movie was inserted successfully!');
        }

        return Redirect::to('createMovieManually')
            ->withInput()
            ->withErrors($validation);
    }

    public function dashboard() {
        return View::make('dashboard');
    }
} 