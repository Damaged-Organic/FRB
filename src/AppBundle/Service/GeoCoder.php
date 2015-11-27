<?php
// src/AppBundle/Service/GeoCoder.php
namespace AppBundle\Service;

class GeoCoder
{
    const GEOCODER_URL = "https://maps.googleapis.com/maps/api/geocode/json?address=";

    public function getCoordinates($address)
    {
        $address = urlencode($address);

        $response = file_get_contents(self::GEOCODER_URL . $address);

        $response = json_decode($response, TRUE);

        if( $response['status'] == "OK" ) {
            $coordinates =
                $response['results'][0]['geometry']['location']['lat']
                . ';' .
                $response['results'][0]['geometry']['location']['lng']
            ;
        } else {
            $coordinates = NULL;
        }

        return $coordinates;
    }
}