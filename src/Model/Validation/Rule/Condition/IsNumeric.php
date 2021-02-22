<?php


namespace Model\Validation\Rule\Condition;


class IsNumeric extends RuleCondition
{

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = preg_match('/^[+-]?\d*\.?\d+$/', $valueToCompare);
        if (!$result) {
            $this->error = "value:{$valueToCompare} is not float";
        }

        return $result;
    }

}