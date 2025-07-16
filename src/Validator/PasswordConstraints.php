<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class PasswordConstraints extends Constraint
{
    public string $message = 'The password does not conform to the minimum strength requirements.';
}
