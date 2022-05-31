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
 * @ORM\Table(name="PortfolioHousingStocks")
 *
 * @OA\Schema()
 */
class HousingStock extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Owner", inversedBy="housingStocks", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A housingstock must have an owner"
     * )
     *
     * @OA\Property(ref="#/components/schemas/owners")
     */
    protected Owner $owner;

    /**
     * @ORM\OneToMany(targetEntity="Block", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/blocks")
     */
    protected Collection $blocks;

    /**
     * @ORM\OneToMany(targetEntity="BuildingType", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/buildingTypes")
     */
    protected Collection $buildingTypes;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="housingStock", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */    
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->buildingTypes = new ArrayCollection();
        $this->addresses = new ArrayCollection();
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
    
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
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
    
    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }
    
    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }

}