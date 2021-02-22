<?php


namespace Model;


class User
{
    /**
     * @var int
     */
    private $id;


    /**
     * @var string
     */
    private $name;


    /**
     * @var Coordinate
     */
    private $coordinates;


    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param Coordinate $coordinates
     */
    public function __construct(int $id, string $name, Coordinate $coordinates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->coordinates = $coordinates;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Coordinate
     */
    public function getCoordinates(): Coordinate
    {
        return $this->coordinates;
    }

}