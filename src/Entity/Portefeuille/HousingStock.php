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
 * @ORM\Table(name="HousingStocks")
 */
class HousingStock extends IdTimeIdentification
{

    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     */
    protected Collection $blocks;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 9999
     * )
     */
    protected int $numberOfBlocks = 0;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 999999
     * )
     */
    protected int $numberOfBuildingAddresses = 0;

    /**
     * @ORM\OneToMany(targetEntity="BuildingType", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     */
    protected Collection $buildingTypes;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="housingStock", fetch="EXTRA_LAZY")
     */    
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToOne(targetEntity="HousingStockOptionSet", cascade={"remove"}, mappedBy="housingStock")
     */
    protected HousingStockOptionSet $housingStockOptionSet;

    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->buildingTypes = new ArrayCollection();
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getBlocks(): ArrayCollection
    {
        return $this->blocks;
    }

    public function getNumberOfBlocks(): int
    {
        return $this->numberOfBlocks;
    }

    public function getNumberOfBuildingAddresses(): int
    {
        return $this->numberOfBuildingAddresses;
    }

    public function getBuildingTypes(): ArrayCollection
    {
        return $this->buildingTypes;
    }
    
    public function getBuildingAddresses(): ArrayCollection
    {
        return $this->buildingAddresses;
    }

    public function getHousingStockOptionSet(): HousingStockOptionSet
    {
        return $this->housingStockOptionSet;
    }

    public function addBlock(Block $block): void
    {
        $this->blocks->add($block);
    }

    public function removeBlock(Block $block): void
    {
        $this->blocks->removeElement($block);
    }

    public function setNumberOfBlocks($numberOfBlocks): void
    {
        $this->numberOfBlocks = $numberOfBlocks;
    }

    public function setNumberOfBuildingAddresses($numberOfBuildingAddresses): void
    {
        $this->numberOfBuildingAddresses = $numberOfBuildingAddresses;
    }

    public function addBuildingType(BuildingType $buildingType): void
    {
        $this->buildingTypes->add($buildingType);
    }

    public function removeBuildingType(BuildingType $buildingType): void
    {
        $this->buildingTypes->removeElement($buildingType);
    }
    
    public function addBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->add($buildingAddress);
    }
    
    public function removeBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->removeElement($buildingAddress);
    }

    public function setHousingStockOptionSet(HousingStockOptionSet $housingStockOptionSet): void
    {
        $this->housingStockOptionSet = $housingStockOptionSet;
    }

}