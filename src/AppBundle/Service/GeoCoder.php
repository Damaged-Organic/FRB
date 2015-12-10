<?php
// src/AppBundle/Service/GeoCoder.php
namespace AppBundle\Service;

use AppBundle\Entity\Estate,
    AppBundle\Entity\Information;

class GeoCoder
{
    const GEOCODER_URL = "https://maps.googleapis.com/maps/api/geocode/json?address=";

    const EARTH_RADIUS = 6371000;
    const CLOSE_ENOUGH = 1000;

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

    public function getClosestMarkers(Estate $estate, array $informationObjects)
    {
        $coordinatesObject = $estate->getCoordinates();

        if( !$coordinatesObject )
            return FALSE;

        $coordinatesObject = explode(';', $coordinatesObject);

        $closestMarkers = [];

        foreach ($informationObjects as $informationObject)
        {
            if( $informationObject instanceof Information )
            {
                $addresses = explode(PHP_EOL, $informationObject->getAddresses());

                foreach( $informationObject->getCoordinates() as $key => $coordinatesMarkers )
                {
                    $coordinatesMarkers = explode(';', $coordinatesMarkers);

                    if( $this->isCloseEnough($coordinatesObject, $coordinatesMarkers) )
                    {
                        $title = $informationObject->getInformationCategory()->getTitle();
                        $alias = $informationObject->getInformationCategory()->getAlias();

                        $closestMarkers[] = [
                            'lat'   => $coordinatesMarkers[0],
                            'lng'   => $coordinatesMarkers[1],
                            'title' => ( !empty($addresses[$key]) ) ? $title . " - " . trim($addresses[$key]) : '',
                            'icon'  => ( $alias ) ? "location-{$alias}" : ''
                        ];
                    }
                }
            }
        }

        return $closestMarkers;
    }

    private function isCloseEnough($coordinatesObject, array $coordinatesMarkers)
    {
        $startLat = deg2rad($coordinatesObject[0]);
        $startLng = deg2rad($coordinatesObject[1]);

        $endLat = deg2rad($coordinatesMarkers[0]);
        $endLng = deg2rad($coordinatesMarkers[1]);

        $deltaLat = $endLat - $startLat;
        $deltaLng = $endLng - $startLng;

        $angle = 2 * asin(sqrt(pow(sin($deltaLat / 2), 2) + cos($startLat) * cos($endLat) * pow(sin($deltaLng / 2), 2)));

        $distance = $angle * self::EARTH_RADIUS;

        return ( $distance <= self::CLOSE_ENOUGH );
    }
}
