<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdBagIds;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class City extends IdBagIds
{
    /**
     * @ORM\Column(type="string", length=80, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The name is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=80,
     *      maxMessage="The name can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    private string $name;

    #[Pure]
    public function __construct()
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}