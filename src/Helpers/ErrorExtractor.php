<?php

namespace App\Helpers;

use Exception;
use JetBrains\PhpStorm\Pure;
use stdClass;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorExtractor
{
    #[Pure]
    public static function fromViolations(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $errors[] = self::simplifyException($violation);
        }
        return $errors;
    }

    #[Pure]
    public static function fromException(Exception $exception): array
    {
        return [self::simplifyException($exception)];
    }

    #[Pure]
    private static function simplifyException(Exception $exception): stdClass
    {
        $error = new stdClass();
        $error->code = $exception->getCode();
        $error->message = $exception->getMessage();
        return $error;
    }
}