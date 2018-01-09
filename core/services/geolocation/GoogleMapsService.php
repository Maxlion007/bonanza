<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.10.2017
 * Time: 16:50
 */

namespace core\services\geolocation;


use core\repositories\ZipcodeRepository;
use SebastianBergmann\GlobalState\RuntimeException;
use yii\db\Exception;

class GoogleMapsService implements MapServiceInterface
{

    public $api_key;
    public $zipcodes;

    public function __construct(ZipcodeRepository $zipcodes)
    {
        $this->zipcodes=$zipcodes;
    }
    public function getCoordinates($address)
        {
            try
            {
                $ch=curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=$address&key={$this->api_key}");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                $coordinates=curl_exec($ch);
//                $coordinates='{ "results" : [ { "address_components" : [ { "long_name" : "Google Building 42", "short_name" : "Google Bldg 42", "types" : [ "premise" ] }, { "long_name" : "1600", "short_name" : "1600", "types" : [ "street_number" ] }, { "long_name" : "Amphitheatre Parkway", "short_name" : "Amphitheatre Pkwy", "types" : [ "route" ] }, { "long_name" : "Mountain View", "short_name" : "Mountain View", "types" : [ "locality", "political" ] }, { "long_name" : "Santa Clara County", "short_name" : "Santa Clara County", "types" : [ "administrative_area_level_2", "political" ] }, { "long_name" : "California", "short_name" : "CA", "types" : [ "administrative_area_level_1", "political" ] }, { "long_name" : "United States", "short_name" : "US", "types" : [ "country", "political" ] }, { "long_name" : "94043", "short_name" : "94043", "types" : [ "postal_code" ] } ], "formatted_address" : "Google Bldg 42, 1600 Amphitheatre Pkwy, Mountain View, CA 94043, USA", "geometry" : { "bounds" : { "northeast" : { "lat" : 37.42198310000001, "lng" : -122.0853195 }, "southwest" : { "lat" : 37.4214139, "lng" : -122.0860042 } }, "location" : { "lat" : 37.4216548, "lng" : -122.0856374 }, "location_type" : "ROOFTOP", "viewport" : { "northeast" : { "lat" : 37.4230474802915, "lng" : -122.0843128697085 }, "southwest" : { "lat" : 37.4203495197085, "lng" : -122.0870108302915 } } }, "place_id" : "ChIJPzxqWQK6j4AR3OFRJ6LMaKo", "types" : [ "premise" ] } ], "status" : "OK" } ';

                $result=json_decode($coordinates);
                if($result->status=='OK')
                {
                    $location=$result->results[0]->geometry->location;
                    //TODO:: what if result returns several coordinates?
                    return ['latitude'=>$location->lat, 'longitude'=>$location->lng];
                }
                else
                    {
                     throw new RuntimeException($result['error']);
                    }
            }catch(Exception $e)
            {
                die($e->getMessage());
            }
        }

    public function getZipcodeBoundaries()
    {
        return $this->zipcodes->getStateZipcodes('CA');
    }
}