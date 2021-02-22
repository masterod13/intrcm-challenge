<?php


namespace Model\Validation;


use Model\Validation\Rule\Condition\GreaterEqualThan;
use Model\Validation\Rule\Condition\IsEmpty;
use Model\Validation\Rule\Condition\IsInteger;
use Model\Validation\Rule\Condition\IsNumeric;
use Model\Validation\Rule\Condition\LesserEqualThan;
use Model\Validation\Rule\Condition\Not;
use Model\Validation\Rule\Required;

class CustomerValidator extends Validator
{

    public function __construct()
    {
        $this->addValidationRule( (new Required('user_id'))
            ->addCondition(new IsInteger())
            ->addCondition(new GreaterEqualThan(0))
        );

        $this->addValidationRule( (new Required('latitude'))
            ->addCondition(new IsNumeric())
            ->addCondition(new GreaterEqualThan(-90))
            ->addCondition(new LesserEqualThan(90))
        );

        $this->addValidationRule( (new Required('longitude'))
            ->addCondition(new IsNumeric())
            ->addCondition(new GreaterEqualThan(-180))
            ->addCondition(new LesserEqualThan(180))
        );

        $this->addValidationRule( (new Required('name'))
            ->addCondition(new Not(new IsEmpty()))
        );
    }

}