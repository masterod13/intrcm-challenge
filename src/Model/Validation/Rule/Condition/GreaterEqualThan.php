<?php


namespace Model\Validation\Rule\Condition;


class GreaterEqualThan extends ComparisonRule
{

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = $valueToCompare >= $this->value;
        if (!$result) {
            $this->error = "value:{$valueToCompare} is not greater equal than {$this->value}";
        }

        return $result;
    }

}