<?php


namespace Tests\Model;

use Model\Parser;
use Model\Reader\ReaderInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ParserTest extends TestCase
{
    use ProphecyTrait;

    public function testReadEmptyString()
    {
        $reader = $this->prophesize(ReaderInterface::class);
        $reader->read()->willReturn('');
        $result = (new Parser())->parse($reader->reveal());
        $this->assertIsArray($result, 'This should be an array');
        $this->assertEmpty($result, 'Should be empty');
    }

    public function testReadNonEmptyStringNoNewLinesNoJson()
    {
        $reader = $this->prophesize(ReaderInterface::class);
        $reader->read()->willReturn('1212121221');
        $result = (new Parser())->parse($reader->reveal());
        $this->assertIsArray($result, 'This should be an array');
        $this->assertNotEmpty($result, 'Should be empty');
    }

    public function testReadNonEmptyStringNewLinesNoJson()
    {
        $reader = $this->prophesize(ReaderInterface::class);
        $reader->read()->willReturn("test line 1\nwewewe\ntest");
        $result = (new Parser())->parse($reader->reveal());
        $this->assertIsArray($result, 'This should be an array');
        $this->assertCount(0, $result, 'Expected size of array is 0');
        $this->assertEmpty($result, 'Should be empty');
    }

    public function testReadNonEmptyStringNoNewLinesJson()
    {
        $reader = $this->prophesize(ReaderInterface::class);
        $reader->read()->willReturn('{"test": 1}');
        $result = (new Parser())->parse($reader->reveal());
        $this->assertIsArray($result, 'This should be an array');
        $this->assertCount(1, $result, 'Expected size of array is 1');
        $this->assertNotEmpty($result, 'Should be empty');
    }

    public function testReadNonEmptyStringNewLinesJson()
    {
        $reader = $this->prophesize(ReaderInterface::class);
        $reader->read()->willReturn("{\"test\": 1}\n{\"test\": 2}\n{\"test\": 3}");
        $result = (new Parser())->parse($reader->reveal());
        $this->assertIsArray($result, 'This should be an array');
        $this->assertCount(3, $result, 'Expected size of array is 3');
        $this->assertNotEmpty($result, 'Should not be empty');
    }


}