<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingSelectionOptionSets")
 */
class BuildingSelectionOptionSet extends Id
{

    /**
     * @ORM\OneToOne(targetEntity="BuildingSelection", inversedBy="buildingSelectionOptionSet")
     * @ORM\JoinColumn(name="buildingselection_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected BuildingSelection $buildingSelection;

    public function getBuildingSelection(): BuildingSelection
    {
        return $this->buildingSelection;
    }

    public function setBuildingSelection(BuildingSelection $buildingSelection): void
    {
        $this->buildingSelection = $buildingSelection;
    }

}