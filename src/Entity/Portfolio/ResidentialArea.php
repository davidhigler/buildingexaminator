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
 * @ORM\Table(name="PortfolioResidentialAreas")
 *
 * @OA\Schema()
 */
class ResidentialArea extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingAddresses")
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
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="residentialArea", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/buildingAddresses")
     */
    protected Collection $buildingAddresses;

    #[Pure]
    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function addBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->add($buildingAddress);
    }

    public function removeBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->removeElement($buildingAddress);
    }

}