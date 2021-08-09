<?php

namespace App\Entity\Portfolio;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingSelections")
 */
class BuildingPlanningSelection extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="buildingSelection")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected Block $block;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="buildingType", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingAddresses;

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
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