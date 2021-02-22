<?php

namespace Helper;

class SimpleHttpClient
{

    private $con;

    public function __construct()
    {
        $this->con = curl_init();
    }

    /**
     * @param string $url
     * @return bool|string
     * @throws HttpErrorException
     */
    public function get(string $url)
    {
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        ];

        return $this->call($url, $options);
    }

    /**
     * @param string $url
     * @param string $body
     * @return bool|string
     * @throws HttpErrorException
     */
    public function post(string $url, string $body)
    {
        $options = [
            CURLOPT_POST => true,
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $body

        ];

        return $this->call($url, $options);
    }

    /**
     * @param string $url
     * @param array $curlOptions
     * @return string
     * @throws HttpErrorException
     */
    private function call(string $url, array $curlOptions)
    {
        curl_setopt_array($this->con, $curlOptions);
        $response = curl_exec($this->con);

        if (curl_errno($this->con)) {
            throw new HttpErrorException("Curl error:" . curl_errno($this->con));
        }

        return $response;
    }

    public function __destruct()
    {
        curl_close($this->con);
    }
}
