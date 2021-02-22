<?php


namespace Model\Validation;

use Model\Coordinate;
use Model\User;

/**
 * Class UserArrayBuilder
 * @package Model\Validation
 * Validates all objects of an array against a specific validator
 */
class UserArrayBuilder
{
    /**
     * @var \stdClass[]
     */
    private $objectsToBeValidated = [];

    /**
     * @var User[]
     */
    private $users = [];

    /**
     * @var array
     */
    protected $errors = [];

    public function __construct(array $objectsToBeValidated)
    {
        $this->objectsToBeValidated = $objectsToBeValidated;

    }

    /**
     * @param Validator $validator
     * @return User[]
     */
    public function build(Validator $validator): array
    {
        foreach ($this->objectsToBeValidated as $toBeValidated) {
            $validator->validate($toBeValidated);
            if (!empty($validator->getErrors())) {
                $this->addErrors($validator->getErrors());
            } else {
                $this->users[] = new User($toBeValidated['user_id'], $toBeValidated['name'],
                    new Coordinate($toBeValidated['latitude'], $toBeValidated['longitude']));
            }
        }

        return $this->users;
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