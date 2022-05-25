<?php

namespace App\Bag\Infrastructure\SQLite;

use SQLite3;
use App\Bag\Application\SQLite\CbsException;

class Repository
{
    private SQLite3 $sqliteDb;

    public function __construct()
    {
        $this->sqliteDb = new SQLite3(
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR .
            'cbs' . DIRECTORY_SEPARATOR .
            'cbs.db');
    }

    public function getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber(string $zipcodeHousenumber): array
    {
        $result = $this->sqliteDb->querySingle('SELECT neighbourhood, residentialarea, municipality FROM cbs WHERE zipcodehousenumber="' . $zipcodeHousenumber . '"', true);

        if (
            !array_key_exists('municipality', $result)
            || !array_key_exists('residentialarea', $result)
            || !array_key_exists('neighbourhood', $result)
        ) {
            $cbsException = new CbsException('missing data in the cbs sqlite database', 0);
            $cbsException->addContext([
                'cbs' => [
                    'missing' => 'municipality or residentialarea or neighbourhood',
                ]
            ]);
            throw $cbsException;
        }

        return $result;
    }
}