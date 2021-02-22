<?php

namespace Model\Writer;

/**
 * Interface WriterInterface
 * @package Model\Writer
 * Actual implementation could be writing  data
 * from to screen, a file or other sources.
 */
interface WriterInterface
{
    public function write();
}