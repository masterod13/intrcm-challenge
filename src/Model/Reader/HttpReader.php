<?php


namespace Model\Reader;


use Helper\HttpErrorException;
use Helper\SimpleHttpClient;

/**
 * Class HttpReader
 * @package Model\Reader
 * This implementation reads from a given url
 */
class HttpReader implements ReaderInterface
{
    /**
     * @var SimpleHttpClient
     */
    private $httpClient;

    /**
     * @var string
     */
    private $url;

    public function __construct(SimpleHttpClient $httpClient, string $url)
    {
        $this->httpClient = $httpClient;
        $this->url = $url;
    }

    /**
     * @return bool|string
     * @throws ReadException
     */
    public function read()
    {
        try {
            return $this->httpClient->get($this->url);
        } catch (HttpErrorException $e) {
            throw new ReadException('There is an error reading specified url', 0, $e);
        }
    }

}