<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="buildingtypes")
 */
class BuildingType extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingTypes")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="buildingType", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToMany(targetEntity="BuildingSelection", mappedBy="buildingType", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingSelections;

    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
        $this->buildingSelections = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getBuildingAddresses(): ArrayCollection
    {
        return $this->buildingAddresses;
    }

    public function getBuildingSelections(): ArrayCollection
    {
        return $this->buildingSelections;
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

    public function addBuildingSelection(BuildingSelection $buildingSelection): void
    {
        $this->buildingSelections->add($buildingSelection);
    }

    public function removeBuildingSelection(BuildingSelection $buildingSelection): void
    {
        $this->buildingSelections->removeElement($buildingSelection);
    }

}