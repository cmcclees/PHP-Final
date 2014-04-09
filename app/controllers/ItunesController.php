<?php
/**
 * Created by PhpStorm.
 * User: cmcclees
 * Date: 4/1/14
 * Time: 5:00 PM
 */

class ItunesController extends BaseController {

    public function movieProcess() {
        $title = Input::get('movie_name');
        $encoded = urlencode($title);
        $imdb = new \Itp\Api\ItunesSearch();
        $json = $imdb->getResults($encoded);

        if($json == null) {
            return Redirect::to('itunes/search')
                ->with('noshow', 'The movie was not found!');
        } else {

            return View::make('itunes/listResults', [
                'results' => $json->results,
                'title' =>$title
            ]);
        }
    }

    public function movieSearch() {
        return View::make('itunes/search');
    }

} 