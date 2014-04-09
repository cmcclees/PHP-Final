<?php
/**
 * Created by PhpStorm.
 * User: cmcclees
 * Date: 4/1/14
 * Time: 5:04 PM
 */

namespace Itp\Api;

use Cache;

class ItunesSearch {

    public function getResults($title) {
        $json = Cache::get("itunes-uscitp-$title");

        if(!$json) {
            $endpoint = "https://itunes.apple.com/search?media=movie&attribute=movieTerm&term=";
            $endpoint .= $title;
            $json = file_get_contents($endpoint);

            Cache::put("itunes-uscitp-$title", $json, 10);
        }

        return json_decode($json);
    }
} 