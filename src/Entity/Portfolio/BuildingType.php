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
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioBuildingtypes")
 *
 * @OA\Schema()
 */
class BuildingType extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingTypes")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A residentialarea must have a housingstock"
     * )
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="buildingType", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
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