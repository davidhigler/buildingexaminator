<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ResidentialAreas")
 */
class ResidentialArea extends IdTimeIdentification
{
    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="residentialArea", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingAddresses;

    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
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