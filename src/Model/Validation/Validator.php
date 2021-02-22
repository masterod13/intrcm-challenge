<?php


namespace Model\Validation;


use Model\Validation\Rule\ValidationRule;

class Validator
{
    /**
     * @var array
     */
    protected $input = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var ValidationRule[]
     */
    protected $validationRules = [];

    /**
     * @param ValidationRule $rule
     * @return Validator
     */
    public function addValidationRule(ValidationRule $rule): Validator
    {
        $this->validationRules[] = $rule;

        return $this;
    }

    /**
     * @param array $input
     */
    public function validate(array $input): void
    {
        if (empty($this->validationRules)) {
            return;
        }
        $this->errors = [];
        foreach ($this->validationRules as $validationRule) {
            if (!$validationRule->isValidRule($input)) {
                $this->addErrors($validationRule->getErrors());
            }
        }
    }

    /**
     * @param array $errors
     */
    protected function addErrors(array $errors): void
    {
        if (!empty($errors)) {
            $this->errors = array_merge($this->errors, $errors);
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