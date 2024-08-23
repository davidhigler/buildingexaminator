<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'PortfolioBuildingTypes')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class BuildingType extends IdTimeIdentification
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    #[ORM\JoinColumn(name: 'housingstock_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \HousingStock::class, inversedBy: 'buildingTypes')]
    #[Assert\NotBlank(message: 'A residentialarea must have a housingstock')]
    protected HousingStock $housingStock;

    /**
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\OneToMany(targetEntity: \Address::class, mappedBy: 'buildingType', fetch: 'EXTRA_LAZY')]
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
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