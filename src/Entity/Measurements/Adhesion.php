<?php


namespace App\Entity\Measurements;

use App\Entity\Portfolio\BuildingAddress;
use App\Entity\SuperClasses\IdTime;


class Adhesion extends IdTime
{
    protected BuildingAddress $address;

    protected int $adhesionRating;

    public function __construct(int $adhesionRating)
    {
        $this->adhesionRating = $adhesionRating;
    }
}