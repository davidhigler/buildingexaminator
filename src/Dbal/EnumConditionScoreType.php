<?php

namespace App\Dbal;

use App\Definition\ConditionScores;

class EnumConditionScoreType extends EnumType
{
    public const ALLOWED_VALUES = ConditionScores::POSSIBLE_VALUES;

    protected string $name = 'enumconditionscore';

    protected array $values = self::ALLOWED_VALUES;
}