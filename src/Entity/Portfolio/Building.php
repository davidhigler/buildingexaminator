<?php

declare(strict_types=1);

namespace App\Entity\Portfolio;

use App\Dbal\EnumBuildingStatusType;
use App\Entity\SuperClasses\IdBagIds;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'PortfolioBuildings')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Building extends IdBagIds
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, nullable: false)]
    #[Assert\NotBlank(message: 'The construction year may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The construction year is not a valid {{ type }}')]
    #[Assert\Range(min: 1800, max: 2100)]
    #[OA\Property]
    protected int $constructionYear;

    #[ORM\Column(type: 'enumbuildingstatus', nullable: true)]
    #[Assert\Choice(choices: EnumBuildingStatusType::ALLOWED_VALUES, message: 'Choose a valid building status type.')]
    #[OA\Property]
    private string $status;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 5, nullable: false)]
    #[Assert\NotBlank(message: 'The residence count number may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The residence count is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 99999)]
    #[OA\Property]
    private int $residenceCount;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 5, nullable: false)]
    #[Assert\NotBlank(message: 'The surface area number may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The surface area is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 99999)]
    #[OA\Property]
    private int $surfaceArea;

    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'building', fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/addresses')]
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getConstructionYear(): int
    {
        return $this->constructionYear;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getResidenceCount(): int
    {
        return $this->residenceCount;
    }

    public function getSurfaceArea(): int
    {
        return $this->surfaceArea;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setConstructionYear(int $constructionYear): void
    {
        $this->constructionYear = $constructionYear;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setResidenceCount(int $residenceCount): void
    {
        $this->residenceCount = $residenceCount;
    }

    public function setSurfaceArea(int $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
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
