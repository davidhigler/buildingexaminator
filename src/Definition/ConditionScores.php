<?php

namespace App\Definition;

class ConditionScores
{
    public const EXCELLENT = 1;
    public const GOOD = 2;
    public const REASONABLE = 3;
    public const MODERATE = 4;
    public const BAD = 5;
    public const MISERABLE = 6;
    public const TO_BE_DETERMINED = 8;
    public const NOT_INSPECTABLE = 9;

    public const POSSIBLE_VALUES = [
        self::EXCELLENT,
        self::GOOD,
        self::REASONABLE,
        self::MODERATE,
        self::BAD,
        self::MISERABLE,
        self::TO_BE_DETERMINED,
        self::NOT_INSPECTABLE
    ];

    public const VALUES = [
        self::EXCELLENT => [
            'score' => self::EXCELLENT,
            'name' => 'excellent',
            'description' => 'occasional minor defects'
        ],
        self::GOOD => [
            'score' => self::GOOD,
            'name' => 'good',
            'description' => 'occasional onset aging'
        ],
        self::REASONABLE => [
            'score' => self::REASONABLE,
            'name' => 'reasonable',
            'description' => 'locally visible aging functional contamination of building and installation parts not endangered'
        ],
        self::MODERATE => [
            'score' => self::MODERATE,
            'name' => 'moderate',
            'description' => 'functional contamination of building and installation parts is occasionally at risk'
        ],
        self::BAD => [
            'score' => self::BAD,
            'name' => 'bad',
            'description' => 'the aging is irreversible'
        ],
        self::MISERABLE => [
            'score' => self::MISERABLE,
            'name' => 'miserable',
            'description' => 'technically ready for demolition'
        ],
        self::TO_BE_DETERMINED => [
            'score' => self::TO_BE_DETERMINED,
            'name' => 'to be determined',
            'description' => 'to be determined on a later date'
        ],
        self::NOT_INSPECTABLE => [
            'score' => self::NOT_INSPECTABLE,
            'name' => 'not inspectable',
            'description' => 'it was not possible to inspect'
        ]
    ];
}