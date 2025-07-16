<?php

namespace App\Bag\Application\Arcgis;

use Exception;
use Throwable;

class ArcgisException extends Exception
{
    private array $context;

    public function __construct(?string $message = null, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
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