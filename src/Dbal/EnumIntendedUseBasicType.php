<?php

namespace App\Dbal;

class EnumIntendedUseBasicType extends EnumType
{
    public const ALLOWED_VALUES = [
        'woonfunctie',
        'industriefunctie',
        'overige gebruiksfunctie',
        'winkelfunctie',
        'logiesfunctie',
        'kantoorfunctie',
        'bijeenkomstfunctie',
        'gezondheidszorgfunctie',
        'onderwijsfunctie',
        'sportfunctie',
        'celfunctie',
    ];

    protected string $name = 'enumintendedusebasic';
    protected array $values = self::ALLOWED_VALUES;
}