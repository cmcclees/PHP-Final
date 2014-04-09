<?php

class Movie extends Eloquent{

    public $timestamps = false;

    public static function search($title, $genre) {

        $movies = Movie::with('movie', 'genre', 'device');

        if($title) {
            $movies->where('title', 'LIKE', "%$title%");
        }
        if($genre != 'all') {
            $movies->where('genre_id','=', "$genre");
        }

        return $movies->take(30)->get();
    }


    public static function searchUserMovies($title, $user_id, $genre) {
        $movies = User::find($user_id)
            ->movies()
            ->where('title', 'LIKE', "%$title%")
            ->where('genre_id', '=', "$genre")
            ->get();
        return $movies;
    }

    public static function userMovies($user_id) {
        $movies = User::find($user_id)->movies;
        return $movies;
    }


    public static function validate($input) {

        return Validator::make($input, [
            'movie_name' => 'required|min:2',
            'genre_id' => 'required|integer',
            'device_id' => 'required|integer',
        ]);
    }

    public function genre()
    {
        return $this->belongsTo('Genre');
    }

    public function device() {
        return $this->belongsTo('Device');
    }

    public function users() {
        return $this->belongsToMany('User', 'watched_movies')->withPivot('device_id');
    }



} 