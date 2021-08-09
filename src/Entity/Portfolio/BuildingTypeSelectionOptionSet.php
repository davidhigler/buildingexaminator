<?php

namespace App\Entity\Portfolio;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingSelectionOptionSets")
 */
class BuildingTypeSelectionOptionSet extends Id
{

    /**
     * @ORM\OneToOne(targetEntity="BuildingTypeSelection", inversedBy="buildingTypeSelectionOptionSet")
     * @ORM\JoinColumn(name="buildingtypeselection_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected BuildingTypeSelection $buildingTypeSelection;

    public function getBuildingTypeSelection(): BuildingTypeSelection
    {
        return $this->buildingTypeSelection;
    }

    public function setBuildingTypeSelection(BuildingTypeSelection $buildingTypeSelection): void
    {
        $this->buildingTypeSelection = $buildingTypeSelection;
    }

}