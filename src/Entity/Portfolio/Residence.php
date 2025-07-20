<?php

declare(strict_types=1);

namespace App\Entity\Portfolio;

use App\Dbal\EnumIntendedUseBasicType;
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
#[ORM\Table(name: 'PortfolioResidences')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Residence extends IdBagIds
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 5, nullable: false)]
    #[Assert\NotBlank(message: 'The surface area number may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The surface area is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 99999)]
    #[OA\Property]
    private int $surfaceArea;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 80, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The status is not a valid {{ type }}')]
    #[Assert\Length(max: 80, maxMessage: 'The status can contain a maximum of %limit% characters')]
    #[OA\Property]
    private string $status;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 255, nullable: false)]
    #[Assert\Type(type: 'string', message: 'The intended use is not a valid {{ type }}')]
    #[Assert\Length(max: 255, maxMessage: 'The intended use can contain a maximum of %limit% characters')]
    #[OA\Property]
    private string $intendedUse;

    #[ORM\Column(type: 'enumintendedusebasic', nullable: true)]
    #[Assert\Choice(choices: EnumIntendedUseBasicType::ALLOWED_VALUES, message: 'Choose a valid intended use basic type.')]
    #[OA\Property]
    private string $intendedUseBasic;

    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'residence', fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/addresses')]
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getSurfaceArea(): int
    {
        return $this->surfaceArea;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getIntendedUse(): string
    {
        return $this->intendedUse;
    }

    public function getIntendedUseBasic(): string
    {
        return $this->intendedUseBasic;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setSurfaceArea(int $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setIntendedUse(string $intendedUse): void
    {
        $this->intendedUse = $intendedUse;
    }

    public function setIntendedUseBasic(string $intendedUseBasic): void
    {
        $this->intendedUseBasic = $intendedUseBasic;
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
