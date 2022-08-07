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
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioNeighbourhoods")
 *
 * @OA\Schema()
 */
class Neighbourhood extends IdCodeName
{
    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="neighbourhood", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    protected Collection $addresses;

    /**
     * @ORM\ManyToOne(targetEntity="Municipality", inversedBy="neighbourhoods", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="municipality_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A address must have a municipality"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Municipality")
     */
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