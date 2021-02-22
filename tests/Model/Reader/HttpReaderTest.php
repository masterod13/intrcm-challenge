<?php


namespace Tests\Model\Reader;

use Helper\SimpleHttpClient;
use Model\Reader\HttpReader;
use Model\Reader\ReadException;
use PHPUnit\Framework\TestCase;

class HttpReaderTest extends TestCase
{
    public function testReadExceptionBecauseOfWrongUrl()
    {
        $this->expectException(ReadException::class);
        $httpReader = new HttpReader(new SimpleHttpClient(), 'http://21sjazdgaxhucaidgbq');
        $httpReader->read();
    }

}