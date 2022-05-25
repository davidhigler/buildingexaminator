<?php

namespace App\Bag\Infrastructure\SQLite;

use SQLite3;

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
        return $this->sqliteDb->querySingle('SELECT neighbourhood, residentialarea, municipality FROM cbs WHERE zipcodehousenumber="' . $zipcodeHousenumber . '"', true);
    }
}