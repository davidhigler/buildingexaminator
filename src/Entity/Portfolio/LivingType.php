<?php

namespace App\Entity\Portfolio;

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
 * @ORM\Table(name="LivingTypes")
 */
class LivingType extends IdTimeIdentification
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Portfolio\BuildingAddress", mappedBy="gebouw_type", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToMany(targetEntity="BuildingTypeSelection", mappedBy="gebouw_type", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingSelection;

    #[Pure]
    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
        $this->buildingSelection = new ArrayCollection();
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function getBuildingSelection(): Collection
    {
        return $this->buildingSelection;
    }

    public function addBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->add($buildingAddress);
    }

    public function removeBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->removeElement($buildingAddress);
    }

    public function addBuildingSelection(BuildingTypeSelection $buildingSelection): void
    {
        $this->buildingSelection->add($buildingSelection);
    }

    public function removeBuildingSelection(BuildingTypeSelection $buildingSelection): void
    {
        $this->buildingSelection->removeElement($buildingSelection);
    }

}