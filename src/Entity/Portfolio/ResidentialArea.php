<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdCodeName;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioResidentialAreas")
 *
 * @OA\Schema()
 */
class ResidentialArea extends IdCodeName
{
    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="residentialArea", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/buildingAddresses")
     */
    protected Collection $buildingAddresses;

    #[Pure]
    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function addBuildingAddress(Address $buildingAddress): void
    {
        $this->buildingAddresses->add($buildingAddress);
    }

    public function removeBuildingAddress(Address $buildingAddress): void
    {
        $this->buildingAddresses->removeElement($buildingAddress);
    }
}