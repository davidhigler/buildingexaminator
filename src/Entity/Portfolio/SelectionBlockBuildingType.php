<?php

namespace App\Entity\Portfolio;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
class SelectionBlockBuildingType extends Id
{
    /**
     * @Assert\Valid()
     */
    protected Block $block;

    /**
     * @Assert\Valid()
     */
    protected BuildingType $buildingType;

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }
}