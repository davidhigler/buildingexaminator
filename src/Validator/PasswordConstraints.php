<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordConstraints extends Constraint
{
    public string $message = 'The password does not conform to the minimum strenght requirements.';
}