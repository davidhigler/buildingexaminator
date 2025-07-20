<?php

declare(strict_types=1);

namespace App\Dbal;

class EnumGlossAngle extends EnumType
{
    public const ALLOWED_VALUES = [null, 20, 60, 85];

    protected string $name = 'enumglossangle';

    protected array $values = self::ALLOWED_VALUES;
}
