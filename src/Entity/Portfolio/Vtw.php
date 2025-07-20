<?php

declare(strict_types=1);

namespace App\Entity\Portfolio;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'PortfolioVtws')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Vtw extends Id
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 32, nullable: false)]
    #[Assert\NotBlank(message: 'The code may not be empty')]
    #[Assert\Type(type: 'string', message: 'The code is not a valid {{ type }}')]
    #[Assert\Length(max: 32, maxMessage: 'The code can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $code;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The type description may not be empty')]
    #[Assert\Type(type: 'string', message: 'The type description is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The type description can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $typeDescription;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The building type description may not be empty')]
    #[Assert\Type(type: 'string', message: 'The building type description is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The building type description can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $buildingTypeDescription;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The construction year description may not be empty')]
    #[Assert\Type(type: 'string', message: 'The construction year description is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The construction year description can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $constructionYearDescription;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The roof type description may not be empty')]
    #[Assert\Type(type: 'string', message: 'The roof type description is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The roof type description can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $roofTypeDescription;

    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'vtw', fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/addresses')]
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTypeDescription(): string
    {
        return $this->typeDescription;
    }

    public function getBuildingTypeDescription(): string
    {
        return $this->buildingTypeDescription;
    }

    public function getConstructionYearDescription(): string
    {
        return $this->constructionYearDescription;
    }

    public function getRoofTypeDescription(): string
    {
        return $this->roofTypeDescription;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setTypeDescription(string $typeDescription): void
    {
        $this->typeDescription = $typeDescription;
    }

    public function setBuildingTypeDescription(string $buildingTypeDescription): void
    {
        $this->buildingTypeDescription = $buildingTypeDescription;
    }

    public function setConstructionYearDescription(string $constructionYearDescription): void
    {
        $this->constructionYearDescription = $constructionYearDescription;
    }

    public function setRoofTypeDescription(string $roofTypeDescription): void
    {
        $this->roofTypeDescription = $roofTypeDescription;
    }

    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }
}
