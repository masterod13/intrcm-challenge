<?php

namespace Tests\Model;

use Model\Coordinate;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{

    public function testSameCoordinates()
    {
        $d = (new Coordinate(0, 0))->calculateDistance(new Coordinate(0, 0));

        $this->assertEquals(0, $d, 'For same coordinates distance should be zero');
    }

    public function testExpectedDistance()
    {
        $d = (new Coordinate(0, 0))->calculateDistance(new Coordinate(90, 0));
        $this->assertEquals(10007557.176093187, $d, 'We have calculated this distance in advance');
    }




}