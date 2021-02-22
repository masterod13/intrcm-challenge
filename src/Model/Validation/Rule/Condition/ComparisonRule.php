<?php


namespace Model\Validation\Rule\Condition;


abstract class ComparisonRule extends RuleCondition
{
    /**
     * @var float|int
     */
    protected $value;

    abstract public function isSatisfied($value);

    public function __construct($value)
    {
        $this->value = $value;
    }

}