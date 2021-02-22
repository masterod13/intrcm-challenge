<?php


namespace Model\Validation\Rule\Condition;


class LesserEqualThan extends ComparisonRule
{

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = $valueToCompare <= $this->value;
        if (!$result) {
            $this->error = "value:{$valueToCompare} is not lesser equal than {$this->value}";
        }

        return $result;
    }

}