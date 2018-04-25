<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;

class MapboxCurl extends Controller
{
    private $LANG = 'es';
    private $API_KEY; // = env("MAPBOX_TOKEN");
    private $API_URL = 'https://api.mapbox.com';
    private $endpoint;

    public function __construct()
    {
        $this->API_KEY = env('MAPBOX_TOKEN');
    }

    private function query()
    {
        $url = $this->API_URL.$this->endpoint.'&access_token='.$this->API_KEY;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function geocode(Building $building)
    {
        $this->endpoint = '/geocoding/v5/mapbox.places/'.
            urlencode($building->address_with_number).', '.urlencode($building->postcode).', '.urlencode($building->region->name).
            '.json?'.
            'types=address&'.
            'country=es&'.
            'region='.$building->region->name.'&'.
            'postcode='.$building->postcode.'&'.
            'language='.$this->LANG;

        $response = $this->query();

        if (false === !$response) {
            $response = json_decode($response);

            if (count($response->features) > 0) {
                return $response->features[0]->center;
            } else {
                return json_decode('{"message":"No maches found"}');
            }
        }

        return json_decode('{"message":"Error on CURL request"}');
    }

    public function reverseGeocode(String $latitude, String $longitude)
    {
        $this->endpoint = '/geocoding/v5/mapbox.places/'.
            $longitude.','.$latitude.
            '.json?language='.$this->LANG;
        $response = $this->query();

        return json_decode($response);
    }
}
