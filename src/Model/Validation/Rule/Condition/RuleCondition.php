<?php


namespace Model\Validation\Rule\Condition;


abstract class RuleCondition
{
    /**
     * @var mixed
     */
    protected $error;

    abstract public function isSatisfied($value);

    /**
     * @return null|string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

}