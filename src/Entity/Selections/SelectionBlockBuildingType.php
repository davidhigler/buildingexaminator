<?php

declare(strict_types=1);

namespace App\Entity\Selections;

use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
class SelectionBlockBuildingType
{
    #[Assert\Valid]
    protected Block $block;

    #[Assert\Valid]
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
