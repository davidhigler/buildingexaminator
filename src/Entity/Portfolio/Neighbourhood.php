<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdCodeName;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'PortfolioNeighbourhoods')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Neighbourhood extends IdCodeName
{
    /**
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\OneToMany(targetEntity: \Address::class, mappedBy: 'neighbourhood', fetch: 'EXTRA_LAZY')]
    protected Collection $addresses;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Municipality")
     */
    #[ORM\JoinColumn(name: 'municipality_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Municipality::class, inversedBy: 'neighbourhoods', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A neighbourhood must have a municipality')]
    protected Municipality $municipality;

    /**
     *
     * @OA\Property(ref="#/components/schemas/ResidentialArea")
     */
    #[ORM\JoinColumn(name: 'residentialarea_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \ResidentialArea::class, inversedBy: 'residentialAreas', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A neighbourhood must have a residential area')]
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