<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdCodeName;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioResidentialAreas")
 *
 * @OA\Schema()
 */
class ResidentialArea extends IdCodeName
{
    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="residentialArea", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
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