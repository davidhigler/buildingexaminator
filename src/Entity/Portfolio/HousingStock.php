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
 * @ORM\Table(name="HousingStocks")
 *
 * @OA\Schema()
 */
class HousingStock extends IdTimeIdentification
{
    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $blocks;

    /**
     * @ORM\OneToMany(targetEntity="BuildingType", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $buildingTypes;

    /**
     * @ORM\OneToMany(targetEntity="LivingType", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $livingTypes;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="housingStock", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */    
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToOne(targetEntity="HousingStockOptionSet", cascade={"remove"}, mappedBy="housingStock")
     *
     * @OA\Property()
     */
    protected HousingStockOptionSet $housingStockOptionSet;

    /**
     * @ORM\OneToOne(targetEntity="Owner", cascade={"remove"}, mappedBy="housingStock")
     *
     * @OA\Property()
     */
    protected Owner $owner;

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
     *
     * @OA\Property()
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
     *
     * @OA\Property()
     */
    protected int $numberOfBuildingAddresses = 0;

    #[Pure]
    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->buildingTypes = new ArrayCollection();
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getBlocks(): Collection
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

    public function getBuildingTypes(): Collection
    {
        return $this->buildingTypes;
    }

    public function getLivingTypes(): Collection
    {
        return $this->livingTypes;
    }
    
    public function getBuildingAddresses(): Collection
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

    public function addLivingType(LivingType $livingType): void
    {
        $this->livingTypes->add($livingType);
    }

    public function removeLivingType(LivingType $livingType): void
    {
        $this->livingTypes->removeElement($livingType);
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