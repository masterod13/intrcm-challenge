<?php


namespace Model\Validation\Rule\Condition;


class IsEmpty extends RuleCondition
{

    /**
     * @param int|float $valueToCompare
     * @return bool
     */
    public function isSatisfied($valueToCompare): bool
    {
        $result = empty($valueToCompare);
        if (!$result) {
            $this->error = "value:{$valueToCompare} is not empty";
        }

        return $result;
    }

}