<?php


namespace Model\Validation;


abstract class ValidationRule
{

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var array $values
     */
    private $values;

    abstract public function getRuleType();

        /**
     * Required constructor.
     * @param string $name
     * @param string $type
     * @param array|string|null $values
     */
    public function __construct(string $name, string $type, $values = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->values = $values;
    }

    public function addCondition()


}