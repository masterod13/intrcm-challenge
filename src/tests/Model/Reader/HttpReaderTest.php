<?php


namespace Model\Reader;


use Helper\HttpErrorException;
use Helper\SimpleHttpClient;
use PHPUnit\Framework\TestCase;


/**
 * Class HttpReader
 * @package Model\Reader
 * This implementation reads from a given url
 */
class HttpReaderTest extends TestCase
{
    /**
     * @return bool|string
     * @throws ReadException
     */
    public function testReadExceptionBecauseOfWrongUrl()
    {
        $this->expectException(ReadException::class);
        $httpReader = new HttpReader(new SimpleHttpClient(), 'http://21sjazdgaxhucaidgbq');
        $httpReader->read();
    }

}