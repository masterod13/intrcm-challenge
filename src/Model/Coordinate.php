<?php

namespace Model;

class Coordinate
{

    private const  EARTH_RADIUS = 6371008.7714;
    /**
     * @var float $latitude
     */
    private $latitude;

    /**
     * @var float $longitude
     */
    private $longitude;

    /**
     * Coordinate constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param Coordinate $c
     * @return float
     */
    public function calculateDistance(Coordinate $c): float
    {
        $lo1 = deg2rad($this->longitude);
        $la1 = deg2rad($this->latitude);
        $lo2 = deg2rad($c->getLongitude());
        $la2 = deg2rad($c->getLatitude());

        return self::EARTH_RADIUS * acos(sin($la1) * sin($la2) + cos($la1) * cos($la2) * cos(abs($lo1 - $lo2)));
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