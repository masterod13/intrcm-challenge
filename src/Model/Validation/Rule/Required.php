<?php


namespace Model\Validation;


class Required extends ValidationRule
{

    public function getRuleType()
    {
        return ValidationConstant::RULE_TYPE_REQUIRED;
    }

}