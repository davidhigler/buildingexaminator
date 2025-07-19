<?php

namespace App\Dbal;

class EnumBuildingStatusType extends EnumType
{
    public const ALLOWED_VALUES = [
        'Bouw gestart',
        'Bouwvergunning verleend',
        'Pand buiten gebruik',
        'Pand in gebruik',
        'Pand in gebruik (niet ingemeten)',
        'Sloopvergunning verleend',
        'Verbouwing pand',
    ];

    protected string $name = 'enumbuildingstatus';

    protected array $values = self::ALLOWED_VALUES;
}