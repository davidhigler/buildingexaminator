<?php

namespace App\Bag\Infrastructure\SQLite;

use SQLite3;

class Repository
{
    public function getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber(string $zipcodeHousenumber): array
    {
        $db = new SQLite3(
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR .
            'cbs' . DIRECTORY_SEPARATOR .
            'cbs.db');
        return $db->querySingle('SELECT neighbourhood, residentialarea, municipality FROM cbs WHERE zipcodehousenumber="' . $zipcodeHousenumber . '"', true);
    }
}