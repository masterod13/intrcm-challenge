<?php

namespace Model\Reader;

/**
 * Interface ReaderInterface
 * @package Model\Reader
 * Actual implementation could be reading data
 * from a url, a file or other sources.
 */
interface ReaderInterface
{
    /**
     * @throws ReadException
     * @return mixed
     */
    public function read();
}