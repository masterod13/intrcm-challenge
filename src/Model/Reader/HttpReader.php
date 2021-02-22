<?php


namespace Model\Reader;


use Helper\SimpleHttpClient;

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
     * @throws \Exception
     */
    public function read()
    {
        return $this->httpClient->get($this->url);
    }

}