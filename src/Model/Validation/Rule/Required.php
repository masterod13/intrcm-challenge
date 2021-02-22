<?php


namespace Model\Validation\Rule;


class Required extends ValidationRule
{

    /**
     * @param array $input
     * @return bool
     */
    public function nameExistsInInput(array $input)
    {
        if (!array_key_exists($this->name, $input)) {
            $this->addError("{$this->name} is required");

            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return true;
    }



}