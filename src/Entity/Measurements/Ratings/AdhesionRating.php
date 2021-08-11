<?php


namespace App\Entity\Measurements\Ratings;

use Symfony\Component\Validator\Constraints as Assert;

class AdhesionRating
{
    private const POSSIBLE_RATINGS = [0, 1, 2, 3, 4, 5];

    public static function fromPrimitive(int $rating): self
    {
        new Assert\Range([
            'min' => 0,
            'max' => 5,
        ]);
    }
}