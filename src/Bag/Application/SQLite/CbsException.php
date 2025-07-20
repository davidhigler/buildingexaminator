<?php

declare(strict_types=1);

namespace App\Bag\Application\SQLite;

use Exception;
use Throwable;

class CbsException extends Exception
{
    private array $context;

    public function __construct($message = null, $code = 0, ?Throwable $throwable = null)
    {
        parent::__construct($message, $code, $throwable);
    }

    public function addContext(array $context): void
    {
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
