<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PasswordConstraintsValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof PasswordConstraints) {
            throw new UnexpectedTypeException($constraint, PasswordConstraints::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (preg_match('/[A-Z]/', $value) !== 1) {
            $this->context->buildViolation('The password does not contain a upper case letter')
                ->addViolation();
        }

        if (preg_match('/[a-z]/', $value) !== 1) {
            $this->context->buildViolation('The password does not contain a lower case letter')
                ->addViolation();
        }

        if (preg_match('/[0-9]/', $value) !== 1) {
            $this->context->buildViolation('The password does not contain a number')
                ->addViolation();
        }

        if (preg_match('/[\x21-\x2F]|[\x3A-\x40]|[\x5B-\x60]|[\x7B-\x7E]|[\x80-\xFF]/', $value) !== 1) {
            $this->context->buildViolation('The password does not contain a special character')
                ->addViolation();
        }
    }
}