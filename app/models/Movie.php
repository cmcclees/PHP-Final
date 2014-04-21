<?php

class Movie extends Eloquent{

    public $timestamps = false;

    public static function searchUserMovies($title, $user_id, $genre) {
        $movies = User::find($user_id)
            ->movies()
            ->where('title', 'LIKE', "%$title%");

        if($genre != '0') {
            $movies->where('genre_id', '=', "$genre");
        }
        return $movies->orderBy('title')->get();
    }

    public static function userMovies($user_id) {
        $movies = User::find($user_id)->movies->sortBy('title');
        return $movies;
    }


    public static function validate($input) {

        return Validator::make($input, [
            'title' => 'required|min:2|unique:movies',
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