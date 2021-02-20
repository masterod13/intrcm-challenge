<?php


class Coordinates
{
    /**
     * @var float $longitude
     */
    private $longitude;

    /**
     * @var float $latitude
     */
    private $latitude;


    public function __construct( float $longitudes, float $latitude )
    {
        $this->longitude = $longitudes;
        $this->latitude = $latitude;
    }

    public function calculateDistance (Coordinates )
    {
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
}