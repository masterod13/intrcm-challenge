<?php


namespace Model\Validation\Rule\Condition;

/**
 * Class Not
 * @package Model\Validation\Rule\Condition
 * We reverse RuleCondition
 */
class Not extends RuleCondition
{
    /**
     * @var RuleCondition
     */
    private $condition;

    /**
     * Not() constructor
     * @param RuleCondition $condition
     */
    public function __construct(RuleCondition $condition)
    {
        $this->condition = $condition;
    }

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = !$this->condition->isSatisfied($valueToCompare);
        if (!$result) {
            $className = (new \ReflectionClass($this->condition))->getShortName();

            $this->error = "value:{$valueToCompare} should NOT be validated with {$className}";
        }

        return $result;
    }

}