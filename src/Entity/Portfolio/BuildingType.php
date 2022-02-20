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
 * @ORM\Table(name="buildingtypes")
 *
 * @OA\Schema()
 */
class BuildingType extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingTypes")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="buildingType", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToMany(targetEntity="BuildingTypeSelection", mappedBy="buildingType", fetch="EXTRA_LAZY")     * @Assert\Valid()
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $buildingTypeSelections;

    #[Pure]
    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
        $this->buildingTypeSelections = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function getBuildingTypeSelections(): Collection
    {
        return $this->buildingTypeSelections;
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

    public function addBuildingTypeSelection(BuildingTypeSelection $buildingTypeSelection): void
    {
        $this->buildingTypeSelections->add($buildingTypeSelection);
    }

    public function removeBuildingTypeSelection(BuildingTypeSelection $buildingTypeSelection): void
    {
        $this->buildingTypeSelections->removeElement($buildingTypeSelection);
    }

}