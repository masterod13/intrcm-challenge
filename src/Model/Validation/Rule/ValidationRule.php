<?php


namespace Model\Validation\Rule;


use Model\Validation\Rule\Condition\RuleCondition;

abstract class ValidationRule
{

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var RuleCondition[] $conditions
     */
    protected $conditions = [];

    /**
     * @var array
     */
    protected $errors = [];


    abstract public function nameExistsInInput(array $input);

    /**
     * Keep it simple for now. In future work might need to
     * add an $input parameter in cases such as conditional required fields
     * @return bool
     */
    abstract public function isRequired(): bool;

    /**
     * Required constructor. Name of the field to be validated
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param RuleCondition $condition
     * @return ValidationRule
     */
    public function addCondition(RuleCondition $condition): ValidationRule
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * @param array $input
     * @return false
     */
    public function isValidRule(array $input): bool
    {
        $this->errors = [];
        if (!$this->nameExistsInInput($input)) {
            return !$this->isRequired();
        }
        $success = true;
        foreach ($this->conditions as $condition) {
            if (!$condition->isSatisfied($input[$this->name])) {
                $this->addError($condition->getError());
                $success = false;
            }
        }

        return $success;
    }

    /**
     * @param string $error
     */
    protected function addError(string $error): void
    {
        if (!empty($error)) {
            $this->errors[] = $error;
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}