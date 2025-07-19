<?php

namespace App\Helpers;

use Exception;
use stdClass;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorExtractor
{
    public static function fromViolations(ConstraintViolationListInterface $constraintViolationList): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($constraintViolationList as $violation) {
            $errors[] = self::simplifyException($violation);
        }

        return $errors;
    }

    public static function fromException(Exception $exception): array
    {
        return [self::simplifyException($exception)];
    }

    private static function simplifyException(Exception|ConstraintViolationInterface $exception): stdClass
    {
        $error = new stdClass();
        $error->code = $exception->getCode();
        $error->message = $exception->getMessage();
        return $error;
    }
}