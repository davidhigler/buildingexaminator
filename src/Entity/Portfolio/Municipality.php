<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdCodeName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'PortfolioMunicipalities')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Municipality extends IdCodeName
{
    /**
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\OneToMany(targetEntity: \Address::class, mappedBy: 'municipality', fetch: 'EXTRA_LAZY')]
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
}