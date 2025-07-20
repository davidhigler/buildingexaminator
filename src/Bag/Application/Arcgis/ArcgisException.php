<?php

declare(strict_types=1);

namespace App\Bag\Application\Arcgis;

use Exception;
use Throwable;

class ArcgisException extends Exception
{
    private array $context;

    public function __construct(?string $message = null, int $code = 0, ?Throwable $throwable = null)
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
