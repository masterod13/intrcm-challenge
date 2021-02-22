<?php


namespace Tests\Model\Validation;


use Model\Validation\Rule\Condition\GreaterEqualThan;
use Model\Validation\Rule\Condition\IsInteger;
use Model\Validation\Rule\Required;
use Model\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    public function testRequiredUserIdIntegerRule()
    {
        $v = new Validator();

        $v->addValidationRule((new Required('user_id'))
            ->addCondition(new IsInteger())
            ->addCondition(new GreaterEqualThan(0))
        )->validate(['user_id' => 10]);

        $this->assertIsArray($v->getErrors(), 'Errors should be an array');
        $this->assertEmpty($v->getErrors(), 'No validation errors should occur');
    }

    public function testRequiredUserIdNonIntegerRule()
    {
        $v = new Validator();

        $v->addValidationRule((new Required('user_id'))
            ->addCondition(new IsInteger())
            ->addCondition(new GreaterEqualThan(0))
        )->validate(['user_id' => 10.2]);

        $this->assertIsArray($v->getErrors(), 'Errors should be an array');
        $this->assertNotEmpty($v->getErrors(), 'No validation errors should occur');
        $this->assertContains('value:10.2 is not an integer', $v->getErrors(),'Integer validation error should exist');
    }
}