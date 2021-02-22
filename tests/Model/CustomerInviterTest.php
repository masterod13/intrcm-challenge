<?php

namespace Model;

use PHPUnit\Framework\TestCase;

class CustomerInviterTest extends TestCase
{

    /**
     * @var Coordinate
     */
    private $dublinOffice;

    protected function setUp(): void
    {
        $this->dublinOffice = new Coordinate(Constants::DUBLIN_OFFICE_LATITUDE, Constants::DUBLIN_OFFICE_LONGITUDE);
    }

    public function testLessThan100kmDistance()
    {
        $a = [
            new User(12, 'Christina McArdle', new Coordinate(52.986375, -6.043701))
        ];

        $r = (new CustomerInviter())->filterCustomers($a, $this->dublinOffice);
        $this->assertIsArray($r);
        $this->assertNotEmpty($r);
    }

    public function testMoreThan100kmDistance()
    {
        $a = [
            new User(12, 'Too Far', new Coordinate(90, -6.043701))
        ];
        $r = (new CustomerInviter())->filterCustomers($a, $this->dublinOffice);
        $this->assertIsArray($r);
        $this->assertEmpty($r);
    }
}