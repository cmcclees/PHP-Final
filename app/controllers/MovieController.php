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
        $title = Input::get('title');
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

        if($validation->fails()) {
            //if unique clause fails grab that movie
            $failed = $validation->failed();

            //allows to input the same movie title with a different genre
            if(count($failed) == 1 && $failed['title']['Unique'][0] == 'movies') {
                $title = Input::get('title');
                $input_genre_id = Input::get('genre_id');

                $movies = Movie::where('title', '=', $title)->get();
                $device_id = Input::get('device_id');
                $user_id = Auth::user()->id;

                foreach($movies as $movie) {
                    //if the genre is different add to the users movies
                    if(($movie->genre_id) === $input_genre_id) {
                        User::find($user_id)->movies()->save($movie, array('device_id' => $device_id));
                        return Redirect::to('addMovie')
                            ->with('flash_notice', 'The movie was inserted successfully!');
                    }
                }
            } else {
                return Redirect::to('createMovieManually')
                    ->withInput()
                    ->withErrors($validation);
            }

        } elseif($validation->passes()) {
                $movie = new Movie();
                $movie->title = Input::get('title');
                $movie->genre_id = Input::get('genre_id');

                $device_id = Input::get('device_id');
                $user_id = Auth::user()->id;


                User::find($user_id)->movies()->save($movie, array('device_id' => $device_id));

                return Redirect::to('addMovie')
                    ->with('flash_notice', 'The movie was inserted successfully!');
        }

        return Redirect::to('createMovieManually')
            ->withInput()
            ->withErrors($validation);
    }

    public function dashboard() {
        $user_id = Auth::user()->id;
        $movies = Movie::userMovies($user_id);
        $genres = Genre::all()->lists('genre_name', 'id');
        $devices = Device::all()->lists('device_type', 'id');

        $device_rows = array();
        $device_table = array();
        $device_table['cols'] = array(
            array('label' => 'Devices', 'type' => 'string'),
            array('label' => 'Movies', 'type' => 'number')
        );


        //counting how many movies watched on each device
        for ($i = 1; $i <= count($devices); $i++) {
            //$device_count[$i][$devices[$i]] = 0;
            $temp = array();
            $temp[] = array('v' => $devices[$i]);
            $temp[] = array('v' => 0);
            $device_rows[] = array('c' => $temp);

            foreach($movies as $movie) {
                if($movie->pivot->device_id == $i) {
                    $device_rows[($i-1)]['c'][1]['v'] += 1;
                }
            }
        }
        $device_table['rows'] = $device_rows;
        $json_devices = json_encode($device_table);


        $genre_rows = array();
        $genre_table = array();
        $genre_table['cols'] = array(
            array('label' => 'Genres', 'type' => 'string'),
            array('label' => 'Movies', 'type' => 'number')
        );
        //counting how many movies of each genre are watched
        for ($i = 1; $i <= count($genres); $i++) {
            //$genre_count[$i][$genres[$i]] = 0;
            $temp = array();
            $temp[] = array('v' => $genres[$i]);
            $temp[] = array('v' => 0);
            $genre_rows[] = array('c' => $temp);
            foreach($movies as $movie) {
                if($movie->genre_id == $i) {
                    $genre_rows[($i-1)]['c'][1]['v'] += 1;
                }
            }
        }
        $genre_table['rows'] = $genre_rows;
        $json_genres = json_encode($genre_table);

        return View::make('users/dashboard', [
            'movies' => $movies,
            'json_devices' => $json_devices,
            'json_genres' => $json_genres,
        ]);
    }

    /*shows all the movies to the admin*/
    public function index() {
        $movies = Movie::all()->sortBy('title');
        return View::make('movies.index')
            ->with('movies', $movies);
    }

    /*
     * show form for editing movie
     * */
    public function edit($id) {
        $movie = Movie::find($id);
        $genres = Genre::all()->lists('genre_name', 'id');

        return View::make('movies.edit', array('genres' => $genres, 'movie' => $movie));
    }

    /*
     * update movie
     * */
    public function update($id) {
        $rules = array(
            'title' => 'required|min:2|unique',
            'genre_id' => 'required|integer',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return Redirect::to('movies/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $movie = Movie::find($id);
            $movie->title = Input::get('title');
            $movie->genre_id = Input::get('genre_id');
            $movie->save();

            Session::flash('flash_notice', 'Successfully updated movie!');
            return Redirect::to('movies');
        }
    }

    /*
     * delete user
     * */
    public function destroy($id) {
        $movie = Movie::find($id);
        //delete all entries for this movie in the pivot table
        $movie->users()->detach();
        //delete the movie
        $movie->delete();
        Session::flash('flash_notice', 'Successfully deleted the movie!');
        return Redirect::to('movies');
    }
} 