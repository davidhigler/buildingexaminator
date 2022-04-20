<?php

namespace App\Dbal;

class EnumOrientationType extends EnumType
{
    public const ALLOWED_VALUES = [null, 'n', 'nne', 'ne', 'nee', 'e', 'see', 'se', 'sse', 's', 'ssw', 'sw', 'sww', 'w', 'nww', 'nw', 'nnw'];

    protected string $name = 'enumorientation';
    protected array $values = self::ALLOWED_VALUES;
}