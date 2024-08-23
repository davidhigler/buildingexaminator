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
#[ORM\Table(name: 'PortfolioResidentialAreas')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class ResidentialArea extends IdCodeName
{
    /**
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\OneToMany(targetEntity: \Address::class, mappedBy: 'residentialArea', fetch: 'EXTRA_LAZY')]
    protected Collection $addresses;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Municipality")
     */
    #[ORM\JoinColumn(name: 'municipality_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Municipality::class, inversedBy: 'residentialareas', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A address must have a municipality')]
    protected Municipality $municipality;

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
}