<?php


namespace Model\Validation\Rule\Condition;


class IsInteger extends RuleCondition
{

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = preg_match('/^[+-]?\d+$/', $valueToCompare);
        if (!$result) {
            $this->error = "value:{$valueToCompare} is not an integer";
        }

        return $result;
    }

}