<?php

namespace App\Entity\Portfolio;

use App\Entity\Authorization\Owner;
use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="housingStocks")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A housingstock must have an owner"
     * )
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Owner $owner;

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
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */    
    protected Collection $buildingAddresses;

    #[Pure]
    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->buildingTypes = new ArrayCollection();
        $this->livingTypes = new ArrayCollection();
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function getNumberOfBlocks(): int
    {
        return count($this->blocks);
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

    public function getNumberOfBuildingAddresses(): int
    {
        return count($this->buildingAddresses);
    }

    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    public function addBlock(Block $block): void
    {
        $this->blocks->add($block);
    }

    public function removeBlock(Block $block): void
    {
        $this->blocks->removeElement($block);
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

}