<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdCodeName;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'PortfolioNeighbourhoods')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Neighbourhood extends IdCodeName
{
    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'neighbourhood', fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/addresses')]
    protected Collection $addresses;

    #[ORM\JoinColumn(name: 'municipality_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Municipality::class, fetch: 'EXTRA_LAZY', inversedBy: 'neighbourhoods')]
    #[Assert\NotBlank(message: 'A neighbourhood must have a municipality')]
    #[OA\Property(ref: '#/components/schemas/Municipality')]
    protected Municipality $municipality;

    #[ORM\JoinColumn(name: 'residentialarea_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: ResidentialArea::class, fetch: 'EXTRA_LAZY', inversedBy: 'residentialAreas')]
    #[Assert\NotBlank(message: 'A neighbourhood must have a residential area')]
    #[OA\Property(ref: '#/components/schemas/ResidentialArea')]
    protected ResidentialArea $residentialArea;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getMunicipality(): Municipality
    {
        return $this->municipality;
    }

    public function getResidentialArea(): ResidentialArea
    {
        return $this->residentialArea;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }

    public function setMunicipality(Municipality $municipality): void
    {
        $this->municipality = $municipality;
    }

    public function setResidentialArea(ResidentialArea $residentialArea): void
    {
        $this->residentialArea = $residentialArea;
    }
}