<?php


namespace App\Entity\Measurements;

use App\Entity\Measurements\Ratings\AdhesionRating;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\SuperClasses\IdTime;

class Adhesion extends IdTime
{
    protected BuildingAddress $address;

    protected AdhesionRating $adhesionRating;
}