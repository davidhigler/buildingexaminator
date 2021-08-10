<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingTypeSelections")
 *
 * @OA\Schema()
 */
class BuildingTypeSelection extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="buildingTypeSelection")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
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
     * @ORM\OneToOne(targetEntity="BuildingTypeSelectionOptionSet", mappedBy="buildingTypeSelection")
     * @Assert\Valid()
     */
    protected BuildingTypeSelectionOptionSet $buildingTypeSelectionOptionSet;

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function getBuildingTypeSelectionOptionSet(): BuildingTypeSelectionOptionSet
    {
        return $this->buildingTypeSelectionOptionSet;
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setBuildingTypeSelectionOptionSet(BuildingTypeSelectionOptionSet $buildingTypeSelectionOptionSet): void
    {
        $this->buildingTypeSelectionOptionSet = $buildingTypeSelectionOptionSet;
    }

}