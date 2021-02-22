<?php


namespace Model\Writer;


/**
 * Class HttpWriter
 * @package Model\Writer
 * This implementation writes to screen an array into json format
 */
class ScreenJsonWriter implements WriterInterface
{

    /**
     * @var array
     */
    private $input = [];

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    /**
     * @return bool|string
     */
    public function write()
    {
        header('Content-Type: application/json');
        echo json_encode($this->input);
    }

}