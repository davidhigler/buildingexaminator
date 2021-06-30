<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingSelections")
 */
class BuildingSelection extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="buildingSelection")
     * @ORM\JoinColumn(name="complex_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected Block $block;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType", inversedBy="buildingSelection")
     * @ORM\JoinColumn(name="buildingtype_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected BuildingType $buildingType;

    /**
     * @ORM\OneToOne(targetEntity="BuildingSelectionOptionSet", mappedBy="buildingSelection")
     * @Assert\Valid()
     */
    protected BuildingSelectionOptionSet $buildingSelectionOptionSet;

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function getBuildingSelectionOptionSet(): BuildingSelectionOptionSet
    {
        return $this->buildingSelectionOptionSet;
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setBuildingSelectionOptionSet(BuildingSelectionOptionSet $buildingSelectionOptionSet): void
    {
        $this->buildingSelectionOptionSet = $buildingSelectionOptionSet;
    }

}